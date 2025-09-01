<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>404 - Página no encontrada</title>
  <style>
    *{margin:0;padding:0;box-sizing:border-box}
    body,html{
      height:100%;
      width:100%;
      font-family:system-ui,Arial,sans-serif;
    }
    .fondo{
      background: url('{{ asset('img/404.gif') }}') no-repeat center center;
      background-size: cover;   /* Ajusta para cubrir toda la pantalla */
      height:100%;
      width:100%;
      display:flex;
      flex-direction:column;
      align-items:center;
      justify-content:center;
      text-align:center;
      color:#fff; /* Texto en blanco para contraste */
      padding:20px;
      position:relative;
    }
    .overlay{ /* capa semitransparente encima del gif para resaltar texto */
      position:absolute;
      top:0; left:0; width:100%; height:100%;
      background:rgba(0,0,0,0.5);
    }
    .content{
      position:relative;
      z-index:2;
    }
    h1{
      font-size:2rem;
      margin-bottom:20px;
      text-shadow:2px 2px 6px rgba(0,0,0,0.8);
    }
    .btn{
      display:inline-block;
      padding:12px 24px;
      border-radius:8px;
      background:#198754;
      color:#fff;
      text-decoration:none;
      font-weight:bold;
      box-shadow:0 4px 6px rgba(0,0,0,0.4);
      transition:0.3s;
    }
    .btn:hover{
      filter:brightness(0.9);
      transform:scale(1.05);
    }
  </style>
</head>
<body>
  <div class="fondo">
    <div class="overlay"></div>
    <div class="content">
      <h1>404</h1>
      <h1>¡Oops! Página no encontrada</h1>
      @auth
      <a class="btn" href="{{ route('libros.index') }}">Volver a libros</a>
      @else
      <a class="btn" href="{{ url('/') }}">Volver al inicio</a>
      @endauth
    </div>
  </div>
</body>
</html>