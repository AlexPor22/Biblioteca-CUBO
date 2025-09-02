<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>En construcción</title>
  <style>
    body, html {
      margin: 0;
      height: 100%;
      width: 100%;
      font-family: Arial, sans-serif;
    }

    .fondo {
      background: url('https://media.tenor.com/kSiC-0wGr4kAAAAM/monkey-technology.gif') no-repeat center center;
      background-size: cover;
      height: 100%;
      width: 100%;
      display: flex;
      align-items: center;
      justify-content: center;
      position: relative;
      color: #fff;
      text-align: center;
    }

    .overlay {
      position: absolute;
      inset: 0;
      background: rgba(0,0,0,0.5);
    }

    .content {
      position: relative;
      z-index: 2;
      padding: 20px;
    }

    h1 {
      font-size: 2.2rem;
      margin-bottom: 12px;
      text-shadow: 2px 2px 6px rgba(0,0,0,0.8);
    }

    p {
      font-size: 1.1rem;
      margin-bottom: 24px;
      text-shadow: 1px 1px 4px rgba(0,0,0,0.7);
    }

    a {
      display: inline-block;
      padding: 12px 22px;
      border-radius: 10px;
      background: #198754;
      color: #fff;
      text-decoration: none;
      font-weight: 700;
      transition: 0.3s;
    }

    a:hover {
      background: #157347;
    }
  </style>
</head>
<body>
  <div class="fondo">
    <div class="overlay"></div>
    <div class="content">
      <h1>🚧 Sección en construcción</h1>
      <p>Estamos trabajando en <strong>Solicitar Préstamo</strong>. Muy pronto estará disponible.</p>
      <a href="{{ route('libros.index') }}">Volver a Libros</a>
    </div>
  </div>
</body>
</html>
