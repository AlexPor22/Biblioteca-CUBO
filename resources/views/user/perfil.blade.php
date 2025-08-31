@extends('layouts.app') {{-- Ajusta a tu layout --}}

@section('title', 'Mi Perfil')

@section('content')

@section('custom-header')
<header class="header">
  <div class="logo">
    <a href="{{ route('inicio') }}">
      <img src="{{ asset('img/CUBOLogoColor.png') }}" alt="Biblioteca Virtual CUBO" class="logo-img">
    </a>
  </div>

  <!-- Menú hamburguesa -->
  <input type="checkbox" id="menu-toggle" class="menu-toggle">
  <label for="menu-toggle" class="hamburger">
    <span></span>
    <span></span>
    <span></span>
  </label>

  <nav class="navbar">
    <ul>
      <li><a href="{{ route('inicio') }}"><i class="fa-solid fa-house"></i>Inicio</a></li>
      <li><a href="{{ route('libros.index') }}"><i class="fas fa-book"></i>Libros</a></li>
       {{-- PERFIL -> va a /perfil --}}
      <li><a href="{{ route('user.perfil') }}"><i class="fa-regular fa-face-smile"></i>Perfil</a></li>
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

<div class="container py-4">
    {{-- Encabezado Perfil --}}
    <div class="profile-hero mb-4">
        <div class="d-flex align-items-center gap-3">
            <div class="avatar-wrap">
                <img src="{{ Str::startsWith($usuario->url_imagen, ['http','https']) ? $usuario->url_imagen : asset('storage/' . $usuario->url_imagen) }}"
                    alt="Avatar" class="w-100 h-100" style="object-fit: cover;">
            </div>
            <div class="flex-grow-1">
                <h3 class="mb-1">{{ $usuario->nombre_completo }}</h3>
                <div class="d-flex align-items-center gap-2">
                    <small class="user-handle">Usuario: {{ '@'.$usuario->nombre_usuario }}</small>

                </div>
                <div class="mt-2">
                    <small class="text-success">{{ $usuario->correo }}</small>
                </div>
            </div>
            <div>
                <a href="{{ route('libros.digitales') }}" class="btn btn-outline-light btn-sm">Volver</a>
            </div>
        </div>
    </div>

    {{-- Tabs --}}
   <ul class="nav mb-3" id="perfilTabs" role="tablist" style="gap:10px;">
    <li class="nav-item" role="presentation">
        <button class="tab-btn active" id="datos-tab" data-bs-toggle="pill" data-bs-target="#datos" type="button" role="tab">
          <div>
            Información
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none" viewBox="0 0 24 24">
              <path d="M11.68 14.62L14.24 12.06L11.68 9.5" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              <path d="M4 12.06H14.17" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              <path d="M12 4C16.42 4 20 7 20 12C20 17 16.42 20 12 20" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </div>
        </button>
    </li>

    <li class="nav-item" role="presentation">
        <button class="tab-btn" id="seguridad-tab" data-bs-toggle="pill" data-bs-target="#seguridad" type="button" role="tab">
          <div>
            Seguridad
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none" viewBox="0 0 24 24">
              <path d="M11.68 14.62L14.24 12.06L11.68 9.5" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              <path d="M4 12.06H14.17" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              <path d="M12 4C16.42 4 20 7 20 12C20 17 16.42 20 12 20" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </div>
        </button>
    </li>

    <li class="nav-item" role="presentation">
        <button class="tab-btn" id="imagen-tab" data-bs-toggle="pill" data-bs-target="#imagen" type="button" role="tab">
          <div>
            Imagen
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none" viewBox="0 0 24 24">
              <path d="M11.68 14.62L14.24 12.06L11.68 9.5" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              <path d="M4 12.06H14.17" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              <path d="M12 4C16.42 4 20 7 20 12C20 17 16.42 20 12 20" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </div>
        </button>
    </li>
</ul>


    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Corrige lo siguiente:</strong>
            <ul class="mb-0">
                @foreach ($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="tab-content">
        {{-- TAB: DATOS --}}
        <div class="tab-pane fade show active" id="datos" role="tabpanel" aria-labelledby="datos-tab">
            <div class="tab-card">
                <form action="{{ route('user.perfil.update') }}" method="POST">
                    @csrf @method('PUT')
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Nombre completo</label>
                            <input type="text" name="nombre" class="form-control" value="{{ old('nombre', $usuario->nombre_completo) }}" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Edad</label>
                            <input type="number" name="edad" class="form-control" value="{{ old('edad', $usuario->edad) }}" min="18">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Sexo</label>
                            <select name="sexo" class="form-select">
                                <option value="">-- Selecciona --</option>
                                @foreach (['masculino'=>'Masculino','femenino'=>'Femenino','otro'=>'Otro'] as $k=>$v)
                                    <option value="{{ $k }}" @selected(old('sexo', $usuario->sexo)===$k)>{{ $v }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Correo</label>
                            <input type="email" name="correo" class="form-control" value="{{ old('correo', $usuario->correo) }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Nombre de usuario</label>
                            <input type="text" name="username" class="form-control" value="{{ old('username', $usuario->nombre_usuario) }}" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Teléfono</label>
                            <input type="text" name="telefono" class="form-control" value="{{ old('telefono', $usuario->numero_telefono) }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Dirección</label>
                            <input type="text" name="direccion" class="form-control" value="{{ old('direccion', $usuario->direccion) }}">
                        </div>
                    </div>

                    <div class="divider"></div>

                    <div class="d-flex justify-content-end gap-2">
                        <button type="reset" class="btn btn-outline-light">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Guardar cambios</button>
                    </div>
                </form>
            </div>
        </div>

        {{-- TAB: SEGURIDAD --}}
        <div class="tab-pane fade" id="seguridad" role="tabpanel" aria-labelledby="seguridad-tab">
            <div class="tab-card">
                <form action="{{ route('user.perfil.password') }}" method="POST" autocomplete="off">
                    @csrf @method('PUT')
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label">Contraseña actual</label>
                            <input type="password" name="password_actual" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Nueva contraseña</label>
                            <input type="password" name="password" class="form-control" minlength="8" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Confirmar nueva contraseña</label>
                            <input type="password" name="password_confirmation" class="form-control" minlength="8" required>
                        </div>
                    </div>

                    <div class="divider"></div>

                    <div class="d-flex justify-content-end gap-2">
                        <button type="reset" class="btn btn-outline-light">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Actualizar contraseña</button>
                    </div>
                </form>
            </div>
        </div>

        {{-- TAB: IMAGEN --}}
        <div class="tab-pane fade" id="imagen" role="tabpanel" aria-labelledby="imagen-tab">
            <div class="tab-card">
                <form action="{{ route('user.perfil.imagen') }}" method="POST" enctype="multipart/form-data">
                    @csrf @method('PUT')
                    <div class="row g-3 align-items-center">
                        <div class="col-md-4">
                            <img id="preview" class="preview"
                                 src="{{ Str::startsWith($usuario->url_imagen, ['http','https']) ? $usuario->url_imagen : asset('storage/' . $usuario->url_imagen) }}"
                                 alt="Previsualización">
                        </div>
                        <div class="col-md-8">
                            <label class="form-label">Seleccionar imagen</label>
                            <input type="file" name="imagen" class="form-control" accept="image/*" onchange="previewImage(event)" required>
                            <small class="text-muted">Formatos: JPG, PNG, WEBP. Máx 2MB.</small>
                        </div>
                    </div>

                    <div class="divider"></div>

                    <div class="d-flex justify-content-end gap-2">
                        <button type="reset" class="btn btn-outline-light" onclick="resetPreview()">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Actualizar imagen</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>




<style>
    .profile-hero{
        background: radial-gradient(80% 120% at 0% 0%, #20c99722 0%, transparent 60%),
                    radial-gradient(80% 120% at 100% 0%, #33cf5722 0%, transparent 60%),
                    linear-gradient(180deg, #0d0d0d, #161616);
        color:#fff; border-radius: 1.5rem; padding:2rem; position:relative; overflow:hidden;
        box-shadow: 0 10px 30px rgba(0,0,0,.25);
    }
    .avatar-wrap{
        width: 120px; height:120px; border-radius:999px; overflow:hidden; border:3px solid rgb(44, 184, 8);
        box-shadow:0 6px 16px rgba(0,0,0,.35); transition: transform .2s ease;
    }
    .avatar-wrap:hover{ transform: scale(1.02); }
    .role-badge{
        display:inline-block; padding:.35rem .7rem; border-radius:999px;
        background:#20c997; color:#0b0b0b; font-weight:600; font-size:.85rem;
    }

    .user-handle{
  color:#20c997;          /* verde de tu paleta */
  font-weight:600;
  text-shadow:0 1px 2px rgba(0,0,0,.6); /* mejora el contraste en el gradiente */
}

    
    .tab-card{
        background:#121212; color:#eaeaea; border:1px solid #2a2a2a; border-radius:1rem; padding:1.25rem;
        box-shadow:0 4px 14px rgba(0,0,0,.2);
    }
    .form-control, .form-select{
        background:#121212; color:#eaeaea; border-color:#2a2a2a;
    }
    .form-control:focus, .form-select:focus{
        border-color:#20c997; box-shadow:0 0 0 .2rem rgba(32,201,151,.15);
    }
    .btn-primary{ background:rgb(44, 184, 8); border:none; }
    .btn-outline-light{ border-color:#444; color:#ddd; }
    .btn-outline-light:hover{ background:#1f1f1f; }
    .divider{ height:1px; background:#2a2a2a; margin:1.25rem 0;}
    .preview{
        width:140px; height:140px; border-radius:1rem; object-fit:cover; border:1px solid #2a2a2a;
    }

    /* Tabs personalizados */
/* === Botones estilo futurista para tabs === */
.tab-btn {
  --color: rgb(44, 184, 8); /* tu color verde */
  position: relative;
  display: flex;
  justify-content: center;
  align-items: center;
  border: none;
  background: transparent;
  transition: all .4s;
  margin-right: .5rem;
}

.tab-btn div {
  letter-spacing: 1px;
  font-weight: 600;
  background: var(--color);
  border-radius: 2rem;
  color: white;
  padding: .7rem 1.4rem;
  transition: all .3s;
  display: flex;
  align-items: center;
  gap: .5rem;
}

.tab-btn::before {
  content: '';
  z-index: -1;
  background-color: var(--color);
  border: 2px solid white;
  border-radius: 2rem;
  width: 115%;
  height: 100%;
  position: absolute;
  transform: rotate(8deg);
  transition: .4s;
  opacity: 0.25;
}

.tab-btn:hover {
  cursor: pointer;
  transform: scale(1.05);
  filter: brightness(1.15);
}

.tab-btn:hover::before {
  transform: rotate(0deg);
  opacity: 1;
}

.tab-btn svg {
  transform: translateX(-120%);
  transition: .4s;
  width: 0;
  opacity: 0;
}

.tab-btn:hover svg {
  width: 22px;
  transform: translateX(0%);
  opacity: 1;
}

.tab-btn.active div {
  background: rgb(44, 184, 8); /* un poco más oscuro para activo */
}

  .navbar ul li a,
.navbar ul li button {
  display: inline-block;
  padding: 8px 16px;
  border: 2px solid rgb(44, 184, 8);;
  border-radius: 999px;
  color: #808080ff;
  background-color: transparent;
  font-weight: 600;
  text-decoration: none;
  transition: all 0.2s ease;
}

.navbar ul li a:hover,
.navbar ul li button:hover {
  background-color: #218838;  /* Verde más oscuro */
  border-color: #218838;
  color: #fff !important;
}

</style>


{{-- JS preview imagen --}}
<script>
function previewImage(e){
    const file = e.target.files[0];
    if(!file) return;
    const url = URL.createObjectURL(file);
    document.getElementById('preview').src = url;
}
function resetPreview(){
    // recarga la página o restablece manualmente si quieres
}
</script>
@endsection
