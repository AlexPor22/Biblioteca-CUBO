@extends('layouts.app')
@section('content')
<div class="container py-4 d-flex flex-column" style="min-height: 100vh;">
  <h2 class="text-center mb-4">Solicitar Préstamo</h2>
  <div class="row">
    @foreach($libros as $libro)
    <div class="col-md-4">
      <div class="card">
        <img src="{{ $libro->portada_url ?: 'https://via.placeholder.com/150' }}" class="card-img-top" alt="{{ $libro->titulo }}">
        <div class="card-body">
          <h5 class="card-title">{{ $libro->titulo }}</h5>
          <p><strong>Código:</strong> {{ $libro->codigo }}</p>
          <p><strong>Estado:</strong> {{ $libro->estado }}</p>
          <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#solicitarModal" data-libro-id="{{ $libro->id }}">Solicitar Préstamo</button>
        </div>
      </div>
    </div>
    @endforeach
  </div>
</div>
<!-- Modal para solicitar el préstamo -->
<div class="modal fade" id="solicitarModal" tabindex="-1" aria-labelledby="solicitarModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="solicitarModalLabel">Formulario de Préstamo</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="prestamoForm" action="" method="POST">
          @csrf
          <input type="hidden" name="libro_id" id="libro_id">
          <div class="mb-3">
            <label for="nombre_usuario" class="form-label">Nombre de Usuario</label>
            <input type="text" class="form-control" id="nombre_usuario" name="nombre_usuario" required>
          </div>
          <div class="mb-3">
            <label for="correo" class="form-label">Correo</label>
            <input type="email" class="form-control" id="correo" name="correo" required>
          </div>
          <div class="mb-3">
            <label for="fecha_prestamo" class="form-label">Fecha de Préstamo</label>
            <input type="text" class="form-control" id="fecha_prestamo" name="fecha_prestamo" value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" readonly>
          </div>
          <div class="mb-3">
            <label for="fecha_devolucion" class="form-label">Fecha de Devolución</label>
            <input type="text" class="form-control" id="fecha_devolucion" name="fecha_devolucion" value="{{ \Carbon\Carbon::now()->addDays(30)->format('Y-m-d') }}" readonly>
          </div>
          <button type="submit" class="btn btn-primary">Aceptar</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- Modal de confirmación de préstamo exitoso -->
@if(session('success'))
<div class="modal fade" id="prestamoExitosoModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Préstamo Exitoso</h5>
      </div>
      <div class="modal-body">
        <p><i class="fas fa-check-circle"></i> Tu préstamo ha sido realizado exitosamente.</p>
      </div>
    </div>
  </div>
</div>
@endif
@endsection

@section('scripts')
<script>
  // Esto va a poner el libro seleccionado en el modal
  const modal = document.getElementById('solicitarModal');
  modal.addEventListener('show.bs.modal', function (event) {
    const button = event.relatedTarget; // Botón que activó el modal
    const libroId = button.getAttribute('data-libro-id');
    const modalLibroId = modal.querySelector('#libro_id');
    modalLibroId.value = libroId;
  });
</script>
@endsection
