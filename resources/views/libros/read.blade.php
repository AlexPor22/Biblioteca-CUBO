@extends('layouts.app')
@section('custom-header')
<header class="header">
    <div class="logo">
        <a href="{{ route('inicio') }}">
            <img src="{{ asset('img/CUBOLogoColor.png') }}" alt="Biblioteca Virtual CUBO" class="logo-img">
        </a>
    </div>

    <input type="checkbox" id="menu-toggle" class="menu-toggle">
    <label for="menu-toggle" class="hamburger">
        <span></span>
        <span></span>
        <span></span>
    </label>

   <nav class="navbar">
    <ul>
        <li><a href="{{ route('inicio') }}"><i class="fa-solid fa-house"></i> Inicio</a></li>
        <li><a href="{{ route('libros.index') }}"><i class="fas fa-book"></i>Libros</a></li>
        <li><a href="{{ route('solicitarPrestamo') }}"><i class="fa-solid fa-book-open-reader"></i>Solicitar Préstamo</a></li>
        <li><a href=""><i class="fa-regular fa-face-smile"></i>Perfil</a></li>
        <li>
            <form action="{{ route('logout') }}" method="POST" style="display:inline;">
        @csrf
        <button type="submit"><i class="fa-solid fa-arrow-right-from-bracket"></i>Cerrar Sesión</button>
        </form>
        </li>
    </ul>
</nav>

</header>
@endsection

@section('content')
<div class="container py-5">
  <h2 class="text-center mb-4">{{ $libro->titulo }}</h2>

  <!-- ===== Toolbar estilo Bookviser ===== -->
  <div class="reader-toolbar d-flex flex-wrap gap-2 align-items-center justify-content-center mb-3">
    <div class="btn-group">
      <button class="btn btn-sm btn-outline-dark" id="smaller">A−</button>
      <button class="btn btn-sm btn-outline-dark" id="bigger">A+</button>
    </div>

    <div class="btn-group" role="group" aria-label="themes">
      <button class="btn btn-sm btn-outline-dark" data-theme="light">Claro</button>
      <button class="btn btn-sm btn-outline-dark" data-theme="sepia">Sepia</button>
      <button class="btn btn-sm btn-outline-dark" data-theme="dark">Noche</button>
    </div>

    <div class="btn-group">
      <button class="btn btn-sm btn-outline-dark" id="justifyToggle">Justificar</button>
      <button class="btn btn-sm btn-outline-dark" id="hyphenToggle">Guiones</button>
    </div>

    <button class="btn btn-sm btn-outline-primary" id="tocToggle">☰ Índice</button>
  </div>

  <!-- Progreso -->
  <div class="reader-progress text-center mb-2">
    <input type="range" id="progress" min="0" max="1000" value="0" style="width: min(900px, 90%);" />
    <div class="small mt-1">
      <span id="pageLabel">p. 1</span> · <span id="percentLabel">0%</span>
    </div>
  </div>

  {{-- VIEWPORT: muestra SIEMPRE dos páginas, sin scroll visible --}}
  <div id="viewport" class="book-viewport">
    <div id="book-content"></div>
  </div>

  <div class="text-center mt-3">
    <button id="prevBtn" class="btn btn-lime me-2">← Página anterior</button>
    <button id="nextBtn" class="btn btn-lime">Página siguiente →</button>
  </div>
</div>

<!-- Panel TOC -->
<aside id="tocPanel" class="toc-panel">
  <div class="toc-header">
    <strong>Índice</strong>
    <button id="tocClose" class="btn btn-sm btn-outline-secondary">Cerrar</button>
  </div>
  <nav id="tocList" class="toc-list"></nav>
</aside>

{{-- Librería ZIP --}}
<script src="https://cdn.jsdelivr.net/npm/jszip@3.10.1/dist/jszip.min.js"></script>
<script>
(function() {
  const epubUrl = @json($epubUrl);

  const viewport   = document.getElementById('viewport');
  const contentEl  = document.getElementById('book-content');
  const prevBtn    = document.getElementById('prevBtn');
  const nextBtn    = document.getElementById('nextBtn');

  // Medidas del “libro” (dos páginas)
  const GAP = 32; // separación entre páginas

  function layoutColumns() {
    // Ancho de cada página = (ancho viewport - gap) / 2
    const pageWidth = Math.floor((viewport.clientWidth - GAP) / 2);
    contentEl.style.columnWidth = pageWidth + 'px';
    contentEl.style.columnGap   = GAP + 'px';
    // Recalcular límites de navegación
    requestAnimationFrame(updateNav);
  }
  window.addEventListener('resize', layoutColumns);

  // Navegación horizontal por spreads (2 columnas a la vez)
  function spreadWidth() {
    // 2 páginas + 1 gap (porque columnas = [página|gap|página])
    const pageW = parseInt(contentEl.style.columnWidth) || Math.floor((viewport.clientWidth - GAP)/2);
    return pageW*2 + GAP;
  }
  function totalColumns() {
    const pageW = parseInt(contentEl.style.columnWidth) || Math.floor((viewport.clientWidth - GAP)/2);
    return Math.ceil(contentEl.scrollWidth / (pageW + GAP));
  }
  function totalSpreads() {
    return Math.max(1, Math.ceil(totalColumns()/2));
  }
  function currentSpreadIndex() {
    const sw = spreadWidth();
    return Math.round(viewport.scrollLeft / sw);
  }
  function updateNav() {
    const i = currentSpreadIndex();
    const last = totalSpreads() - 1;
    prevBtn.disabled = (i <= 0);
    nextBtn.disabled = (i >= last);
  }
  function goSpread(delta) {
    const sw = spreadWidth();
    viewport.scrollTo({ left: Math.max(0, viewport.scrollLeft + delta*sw), behavior: 'smooth' });
    setTimeout(updateNav, 250);
  }
  prevBtn.addEventListener('click', () => goSpread(-1));
  nextBtn.addEventListener('click', () => goSpread(+1));
  document.addEventListener('keydown', e => {
    if (e.key === 'ArrowRight') goSpread(+1);
    if (e.key === 'ArrowLeft')  goSpread(-1);
  });

  // ==== CARGA DEL EPUB Y REESCRITURA DE RUTAS ====
  fetch(epubUrl).then(r => r.arrayBuffer()).then(async buf => {
    const zip = await JSZip.loadAsync(buf);

    // 1) localizar .opf vía container.xml (ruta raíz puede variar)
    const containerXml = await zip.file('META-INF/container.xml').async('text');
    const parser = new DOMParser();
    const containerDoc = parser.parseFromString(containerXml, 'application/xml');
    const opfPath = containerDoc.querySelector('rootfile')?.getAttribute('full-path');
    if (!opfPath) throw new Error('No se encontró el OPF');

    const opfDir  = opfPath.substring(0, opfPath.lastIndexOf('/')+1); // p.ej. "OEBPS/"
    const opfXml  = await zip.file(opfPath).async('text');
    const opfDoc  = parser.parseFromString(opfXml, 'application/xml');

    // 2) manifest (id -> href, tipo, props) y spine (orden de lectura)
    const manifest = {};
    opfDoc.querySelectorAll('manifest > item').forEach(it => {
      manifest[it.getAttribute('id')] = {
        href: it.getAttribute('href'),
        type: it.getAttribute('media-type'),
        props: it.getAttribute('properties') || ''
      };
    });
    const spine = Array.from(opfDoc.querySelectorAll('spine > itemref'))
      .map(it => manifest[it.getAttribute('idref')])
      .filter(Boolean);

    // 3) detectar portada si existe
    let coverHref = null;
    Object.values(manifest).forEach(m => {
      if ((m.props || '').includes('cover-image')) coverHref = m.href;
    });

    // 4) helper: crear URL blob para cualquier recurso del zip
    async function blobUrlFromZip(path) {
      const f = zip.file(path);
      if (!f) return null;
      const blob = await f.async('blob');
      return URL.createObjectURL(blob);
    }

    // 5) construir HTML concatenado del libro (solo BODY de cada xhtml del spine)
    let htmlParts = [];

    // Portada al inicio si existe
    if (coverHref) {
      const url = await blobUrlFromZip(opfDir + coverHref);
      if (url) htmlParts.push(`<section class="page-cover"><img src="${url}" alt="portada" /></section>`);
    }

    for (const item of spine) {
      if (!item.type?.includes('xhtml') && !item.type?.includes('html')) continue;

      const xhtml = await zip.file(opfDir + item.href).async('text');
      const doc   = parser.parseFromString(xhtml, 'application/xhtml+xml');

      // Reescribir <img src=""> a blob URLs del zip (rutas relativas al xhtml)
      const imgs = doc.querySelectorAll('img[src]');
      for (const img of imgs) {
        const src = img.getAttribute('src');
        if (!src) continue;
        const abs = normalizePath(opfDir + resolveRel(item.href, src));
        const url = await blobUrlFromZip(abs);
        if (url) img.setAttribute('src', url);
      }

      // Body only
      const bodyHTML = doc.body ? doc.body.innerHTML : xhtml;
      htmlParts.push(`<section class="chapter" data-src="${item.href}">${bodyHTML}</section>`);
    }

    contentEl.innerHTML = htmlParts.join('\n');

    // aplicar layout de columnas (paginación)
    layoutColumns();

    // ======== Exponer datos para el parche (TOC, etc.) ========
    window._zip = zip;
    window._opfDoc = opfDoc;
    window._manifest = manifest;
    window._spine = spine;
    window._opfDir = opfDir;

    // Notificar que el EPUB está listo
    document.dispatchEvent(new Event('epubLoaded'));
  }).catch(err => {
    console.error('Error cargando EPUB:', err);
  });

  // ==== utilidades de rutas relativas dentro del zip ====
  function resolveRel(fromFile, rel) {
    // fromFile: "Text/chap1.xhtml"  rel: "../Images/pic.jpg"
    const base = fromFile.split('/').slice(0,-1); // carpeta del xhtml
    const parts = rel.split('/');
    for (const p of parts) {
      if (p === '.' || p === '') continue;
      if (p === '..') base.pop();
      else base.push(p);
    }
    return base.join('/');
  }
  function normalizePath(p) {
    const out = [];
    p.split('/').forEach(seg => {
      if (!seg || seg === '.') return;
      if (seg === '..') out.pop();
      else out.push(seg);
    });
    return out.join('/');
  }

  // ====== Exponer funciones clave al scope global para el parche ======
  window.layoutColumns = layoutColumns;
  window.spreadWidth   = spreadWidth;
  window.updateNav     = updateNav;
  window.goSpread      = goSpread;

})();
</script>

<!-- ===== Parche "Bookviser-like": temas, progreso, TOC, posición, notas, zoom, flip ===== -->
<script>
(function patchReader(){
  // DOM refs
  const viewport   = document.getElementById('viewport');
  const contentEl  = document.getElementById('book-content');

  // ===== Ajustes tipográficos / temas =====
  const root = document.documentElement;
  const toolbar = {
    smaller: document.getElementById('smaller'),
    bigger:  document.getElementById('bigger'),
    themeBtns: document.querySelectorAll('[data-theme]'),
    justify: document.getElementById('justifyToggle'),
    hyphens: document.getElementById('hyphenToggle'),
  };
  const toc = {
    panel: document.getElementById('tocPanel'),
    list:  document.getElementById('tocList'),
    toggle:document.getElementById('tocToggle'),
    close: document.getElementById('tocClose')
  };
  const prog = {
    range: document.getElementById('progress'),
    pageLabel: document.getElementById('pageLabel'),
    percent: document.getElementById('percentLabel')
  };

  // Estado (persistente)
  let fontSize = parseInt(getComputedStyle(contentEl).fontSize) || 16;
  let justify  = false;
  let hyphens  = false;
  let theme    = localStorage.getItem('reader.theme') || 'light';

  applyTheme(theme);

  toolbar.smaller?.addEventListener('click', ()=>{ fontSize = Math.max(12, fontSize-1); applyFont(); });
  toolbar.bigger ?.addEventListener('click', ()=>{ fontSize = Math.min(24, fontSize+1); applyFont(); });
  toolbar.themeBtns.forEach(b=> b.addEventListener('click', ()=> applyTheme(b.dataset.theme)));
  toolbar.justify?.addEventListener('click', ()=>{
    justify = !justify; root.style.setProperty('--justify', justify?'justify':'left');
  });
  toolbar.hyphens?.addEventListener('click', ()=>{
    hyphens = !hyphens; root.style.setProperty('--hyphens', hyphens?'auto':'manual');
  });
  function applyFont(){
    root.style.setProperty('--fontSize', fontSize+'px');
    // relayout al cambiar tamaño
    window.layoutColumns && window.layoutColumns();
  }
  function applyTheme(t){
    document.body.classList.remove('theme-light','theme-sepia','theme-dark');
    document.body.classList.add('theme-'+t);
    localStorage.setItem('reader.theme', t);
  }

  // ===== Paginación: páginas, progreso y “flip” =====
  function pageWidth(){
    return parseInt(contentEl.style.columnWidth) || Math.floor((viewport.clientWidth - 32)/2);
  }
  function columnsTotal(){
    const pw = pageWidth();
    return Math.ceil(contentEl.scrollWidth / (pw + 32));
  }
  function pagesTotal(){ return Math.max(2, columnsTotal()); }
  function pageIndex(){ // 0-based (izquierda del spread)
    const sw = window.spreadWidth ? window.spreadWidth() : (pageWidth()*2 + 32);
    const idxSpread = Math.round(viewport.scrollLeft / sw);
    return Math.min(pagesTotal()-2, Math.max(0, idxSpread*2));
  }

  function updateProgressUI(){
    const leftPage = pageIndex()+1;         // humano 1-based
    const total    = pagesTotal();
    const perc     = Math.min(100, Math.round((leftPage/total)*100));
    prog.pageLabel.textContent = `p. ${leftPage}-${leftPage+1} / ${total}`;
    prog.percent.textContent   = `${perc}%`;
    prog.range.value = Math.round((leftPage/total)*1000);
  }

  // engancha updateNav para también refrescar progreso
  const _updateNavOrig = window.updateNav || function(){};
  window.updateNav = function(){
    _updateNavOrig();
    updateProgressUI();
    savePosition();
  };

  // Barra de progreso “scrub”
  prog.range?.addEventListener('input', ()=>{
    const total = pagesTotal();
    const targetLeftPage = Math.max(1, Math.round((prog.range.value/1000)*total));
    const sw = window.spreadWidth ? window.spreadWidth() : (pageWidth()*2 + 32);
    const spreadIdx = Math.floor((targetLeftPage-1)/2);
    viewport.scrollTo({ left: spreadIdx*sw, behavior: 'auto' });
    updateProgressUI();
  });

  // “Flip” sutil al pasar spread
  function flipFx(){
    viewport.classList.add('turning');
    setTimeout(()=> viewport.classList.remove('turning'), 180);
  }
  const _goSpreadOrig = window.goSpread || function(delta){
    const sw = window.spreadWidth ? window.spreadWidth() : (pageWidth()*2 + 32);
    viewport.scrollLeft = Math.max(0, viewport.scrollLeft + delta*sw);
  };
  window.goSpread = function(delta){
    flipFx();
    _goSpreadOrig(delta);
  };

  // ===== Guardar/restaurar posición por libro =====
  const bookKey = 'reader.pos.' + ({{ $libro->id ?? '0' }});
  function savePosition(){
    const sw = window.spreadWidth ? window.spreadWidth() : (pageWidth()*2 + 32);
    const spreadIdx = Math.round(viewport.scrollLeft / sw);
    localStorage.setItem(bookKey, String(spreadIdx));
  }
  function restorePosition(){
    const sw = window.spreadWidth ? window.spreadWidth() : (pageWidth()*2 + 32);
    const idx = parseInt(localStorage.getItem(bookKey) || '0', 10);
    viewport.scrollLeft = idx*sw;
    updateProgressUI();
  }
  viewport.addEventListener('scroll', throttle(updateProgressUI, 150));
  function throttle(fn, ms){
    let t=0; return (...a)=>{ const now=Date.now(); if(now-t>ms){ t=now; fn(...a); } };
  }

  // ===== TOC (nav.xhtml o NCX) =====
  document.addEventListener('epubLoaded', async ()=>{
    try{
      // 1) EPUB3 nav.xhtml
      let navItem = Object.values(window._manifest || {}).find(m => (m.props||'').includes('nav'));
      if(navItem){
        const navHtml = await window._zip.file((window._opfDir||'') + navItem.href).async('text');
        buildTocFromHTML(navHtml, navItem.href);
      } else {
        // 2) EPUB2 NCX
        const spineNode = window._opfDoc?.querySelector('spine');
        const ncxId = spineNode?.getAttribute('toc');
        const ncxItem = (window._manifest || {})[ncxId || ''];
        if(ncxItem && /ncx$/i.test(ncxItem.href)){
          const ncxXml = await window._zip.file((window._opfDir||'') + ncxItem.href).async('text');
          buildTocFromNCX(ncxXml, ncxItem.href);
        }
      }
    }catch(e){ console.warn('TOC no disponible', e); }
    // restaurar posición justo después del layout
    setTimeout(restorePosition, 50);
  });

  const normalizePath = window.normalizePath || (p=>p);
  const resolveRel    = window.resolveRel    || ((fromFile, rel)=>rel);

  const tocEls = {
    panel: document.getElementById('tocPanel'),
    list:  document.getElementById('tocList'),
    toggle:document.getElementById('tocToggle'),
    close: document.getElementById('tocClose')
  };
  tocEls.toggle?.addEventListener('click', ()=> tocEls.panel.classList.add('open'));
  tocEls.close ?.addEventListener('click', ()=> tocEls.panel.classList.remove('open'));

  function buildTocFromHTML(html, baseHref){
    const p = new DOMParser().parseFromString(html, 'text/html');
    let links = p.querySelectorAll('nav[epub\\:type="toc"] a, nav#toc a, nav.toc a, nav ol li a, ol li a');
    if(!links || links.length===0){ links = p.querySelectorAll('a[href]'); }
    appendToc(Array.from(links).map(a=>({ href:a.getAttribute('href'), text:(a.textContent||'Sección').trim() })), baseHref);
  }
  function buildTocFromNCX(xml, baseHref){
    const p = new DOMParser().parseFromString(xml, 'application/xml');
    const points = p.querySelectorAll('navPoint content');
    appendToc(Array.from(points).map(c=>{
      const text = c.parentElement.querySelector('navLabel text')?.textContent || 'Sección';
      return { href: c.getAttribute('src'), text };
    }), baseHref);
  }
  function appendToc(items, baseHref){
  tocEls.list.innerHTML = '';
  items.forEach(it=>{
    if(!it.href) return;
    const a = document.createElement('a');
    a.textContent = it.text;
    a.href = '#';
    a.addEventListener('click', (e)=>{
      e.preventDefault();
      const target = normalizePath((window._opfDir||'') + resolveRel(baseHref, it.href));
      const [filePath, hash] = target.split('#');

      // 1) localizar la <section> que corresponde a ese capítulo
      const chapterEl = contentEl.querySelector(`.chapter[data-src="${filePath.replace(window._opfDir,'')}"]`);
      if(chapterEl){
        let el = chapterEl;
        // 2) si hay ancla (#id), buscar dentro
        if(hash){
          const inner = chapterEl.querySelector(`#${CSS.escape(hash)}`);
          if(inner) el = inner;
        }
        // 3) hacer scroll exacto
        const left = el.offsetLeft; // posición dentro de las columnas
        viewport.scrollTo({ left, behavior:'smooth' });
        tocEls.panel.classList.remove('open');
      }
    });
    tocEls.list.appendChild(a);
  });
}


  // ===== Notas al pie emergentes (anchors a #id) =====
  contentEl.addEventListener('click', (e)=>{
    const a = e.target.closest('a[href^="#"]'); if(!a) return;
    const id = a.getAttribute('href').slice(1);
    const node = contentEl.querySelector(`[id="${CSS.escape(id)}"]`);
    if(!node) return;
    e.preventDefault();
    showFootnote(a, node);
  });
  function showFootnote(anchor, noteNode){
    removeFootnotes();
    const pop = document.createElement('div');
    pop.className = 'footnote-pop';
    pop.innerHTML = noteNode.innerHTML;
    document.body.appendChild(pop);
    const rect = anchor.getBoundingClientRect();
    pop.style.top  = (rect.bottom + 8 + window.scrollY) + 'px';
    pop.style.left = Math.min(window.innerWidth-340, rect.left + window.scrollX) + 'px';
    function close(){ pop.remove(); document.removeEventListener('click', onDoc); }
    function onDoc(ev){ if(!pop.contains(ev.target)) close(); }
    setTimeout(()=> document.addEventListener('click', onDoc), 0);
  }
  function removeFootnotes(){ document.querySelectorAll('.footnote-pop').forEach(n=>n.remove()); }

  // ===== Zoom de imágenes =====
  contentEl.addEventListener('click', (e)=>{
    const img = e.target.closest('img'); if(!img) return;
    const wrap = document.createElement('div'); wrap.className = 'img-zoom';
    const big = new Image(); big.src = img.src;
    wrap.appendChild(big);
    wrap.addEventListener('click', ()=> wrap.remove());
    document.body.appendChild(wrap);
  });

  // ===== Restaurar posición al relayout =====
  const _layoutOrig = window.layoutColumns || function(){};
  window.layoutColumns = function(){
    _layoutOrig();
    requestAnimationFrame(()=> requestAnimationFrame(restorePosition));
  };
})();
</script>

<style>
/* ===== Viewport de libro: 2 páginas visibles, efecto 3D ===== */
.book-viewport{
  margin: 0 auto;
  max-width: 1100px;
  height: 620px;
  border: 1px solid #8b8b8bff;
  border-radius: 12px;
  background: #fdfdfc;
  overflow: hidden;
  padding: 16px;
  position: relative;

  /* Sombras en capas */
  box-shadow:
    0 8px 16px rgba(0, 0, 0, 0.15),   /* sombra principal */
    0 16px 32px rgba(0, 0, 0, 0.1),   /* profundidad */
    0 2px 4px rgba(0, 0, 0, 0.2) inset; /* sutil relieve interno */

  /* efecto 3D sutil */
  transform: perspective(1200px) rotateX(2deg) rotateY(-1deg);
  transition: transform 0.4s ease, box-shadow 0.4s ease;
}

/* Hover: simula levantar el libro */
.book-viewport:hover{
  transform: perspective(1200px) rotateX(0deg) rotateY(0deg) translateY(-6px);
  box-shadow:
    0 12px 24px rgba(0, 0, 0, 0.25),
    0 20px 40px rgba(0, 0, 0, 0.15);
}

/* ===== Contenido paginado por columnas ===== */
#book-content{
  height: 100%;
  /* column-width y column-gap se setean por JS para cuadrar 2 páginas exactas */
  line-height: 1.65;
  font-size: var(--fontSize, 16px);
  color: var(--fg, #111);
  text-align: var(--justify, left);
  -webkit-hyphens: var(--hyphens, manual);
  hyphens: var(--hyphens, manual);
}

/* ===== Temas ===== */
:root{ --bg:#fdfdfc; --fg:#111; }
.theme-light  { --bg:#fdfdfc; --fg:#111; }
.theme-sepia  { --bg:#f6f0e6; --fg:#2a1e12; }
.theme-dark   { --bg:#0f1115; --fg:#e5e7eb; }

.book-viewport{ background: var(--bg); color: var(--fg); }
.reader-toolbar .btn, .btn-lime{ border-radius: 10px; }

/* ===== Panel TOC ===== */
.toc-panel{
  position: fixed; top: 0; right: -320px; width: 320px; height: 100vh;
  background: var(--bg); color: var(--fg); border-left: 1px solid rgba(0,0,0,.15);
  box-shadow: -8px 0 24px rgba(0,0,0,.15);
  padding: 12px; transition: right .25s ease; z-index: 9999;
}
.toc-panel.open{ right: 0; }
.toc-header{ display:flex; align-items:center; justify-content:space-between; margin-bottom:8px; }
.toc-list{ max-height: calc(100vh - 70px); overflow:auto; }
.toc-list a{ display:block; padding:6px 8px; border-radius:8px; text-decoration:none; color:inherit; }
.toc-list a:hover{ background: rgba(0,0,0,.06); }

/* ===== Barra de progreso ===== */
#progress{ accent-color: currentColor; }

/* ===== Flip sutil ===== */
.book-viewport.turning{
  transition: transform 0.25s ease, box-shadow 0.25s ease;
  transform: perspective(1200px) rotateY(-1deg);
}

/* ===== Imágenes y portada ===== */
#book-content img{
  max-width: 100%;
  height: auto;
  display: block;
  margin: 0 auto;
}
.page-cover img{
  width: 100%;
  height: auto;
  display: block;
  margin: 0 auto 1rem;
}

/* ===== Zoom de imágenes ===== */
#book-content img{ cursor: zoom-in; }
.img-zoom{
  position: fixed; inset: 0; background: rgba(0,0,0,.7);
  display:flex; align-items:center; justify-content:center; z-index: 10000;
}
.img-zoom img{ max-width:90vw; max-height:90vh; cursor: zoom-out; border-radius: 8px; }

/* ===== Botón verde limón ===== */
.btn-lime{
  background: #95ff00;     /* verde limón */
  border: 1px solid #7be000;
  color: #0b2e13;
  font-weight: 700;
  padding: 10px 16px;
  border-radius: 10px;
}
.btn-lime:hover{ filter: brightness(0.95); }
.btn-lime:disabled{ opacity:.5; cursor:not-allowed; }

/* Evitar que los títulos/subtítulos empiecen en mitad de página */
#book-content h1,
#book-content h2,
#book-content h3,
#book-content h4,
#book-content h5,
#book-content h6 {
  break-before: column;          /* para columnas */
  page-break-before: always;     /* fallback para impresoras/navegadores viejos */
  margin-top: 1em;
  margin-bottom: 0.5em;
}

/* Evitar cortes feos dentro de títulos o subtítulos */
#book-content h1,
#book-content h2,
#book-content h3 {
  break-inside: avoid;
}

.navbar ul li a,
.navbar ul li button {
  display: inline-block;
  padding: 8px 16px;
  border: 2px solid rgb(44, 184, 8);;     /* verde CUBO */
  border-radius: 999px;           /* full círculo */
  color: #949494ff;
  background-color: transparent;
  text-decoration: none;
  font-weight: 600;
  transition: background-color 0.2s ease, color 0.2s ease;
}

.navbar ul li a:hover,
.navbar ul li button:hover {
  background-color: #218838;  /* Verde más oscuro */
  border-color: #218838;
  color: #fff !important;
}

</style>
@endsection
