@extends('layout.navbar')

@section('titulo', 'Lista de Menús')

@section('contenido')
<link rel="stylesheet" href="{{ asset('css/generalTable.css') }}">

<main class="content">
    <div class="header-section">
        <h2>Listado de Menús</h2>
        <button class="btn-add" id="abrirModalAgregar">+ Nuevo Menú</button>
    </div>

    @if (session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger text-center">{{ session('error') }}</div>
    @endif

    <div class="table-container">
        <table class="roles-table">
            <thead>
                <tr>
                    <th>Foto</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Precio (Bs)</th>
                    <th>Disponibilidad</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($menus as $menu)
                <tr>
                    <td>
                        @if ($menu->foto)
                            <img src="{{ asset($menu->foto) }}" alt="Foto" style="width: 70px; height: 70px; border-radius: 8px; object-fit: cover;">
                        @else
                            <span class="text-muted">Sin imagen</span>
                        @endif
                    </td>
                    <td>{{ $menu->nombre }}</td>
                    <td>{{ Str::limit($menu->descripcion, 50) }}</td>
                    <td>{{ number_format($menu->precio, 2) }}</td>
                    <td>
                        @if ($menu->disponibilidad)
                            <span style="background-color:#00e078;color:white;padding:4px 10px;border-radius:8px;font-weight:bold;font-size:0.9rem;">Disponible</span>
                        @else
                            <span style="background-color:#dc3545;color:white;padding:4px 10px;border-radius:8px;font-weight:bold;font-size:0.9rem;">No disponible</span>
                        @endif
                    </td>
                    <td>
                        <button class="btn-edit btn-abrir-editar"
                            data-id="{{ $menu->id }}"
                            data-nombre="{{ $menu->nombre }}"
                            data-descripcion="{{ $menu->descripcion }}"
                            data-precio="{{ $menu->precio }}"
                            data-disponibilidad="{{ $menu->disponibilidad }}">
                            Editar
                        </button>

                        <form action="{{ route('eliminar.menu') }}" method="POST" style="display:inline;">
                            @csrf
                            <input type="hidden" name="id" value="{{ $menu->id }}">
                            <button type="submit" class="btn-delete" onclick="return confirm('¿Seguro que deseas eliminar este menú?')">
                                Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</main>

{{-- === MODAL AGREGAR === --}}
<div id="modalAgregar" class="modal-overlay" style="display:none;">
  <div class="modal-contenido">
    <div class="modal-header">
      <h2>Agregar Menú</h2>
      <button id="cerrarModalAgregar" class="btn-cerrar">&times;</button>
    </div>

    <form action="{{ route('crear.menu') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="campo-form">
        <label>Nombre del Plato</label>
        <input type="text" name="nombre" required>
      </div>
      <div class="campo-form">
        <label>Descripción</label>
        <input type="text" name="descripcion" required>
      </div>
      <div class="campo-form">
        <label>Precio (Bs)</label>
        <input type="number" name="precio" step="0.01" required>
      </div>
      <div class="campo-form">
        <label>Disponibilidad</label>
        <select name="disponibilidad" required>
          <option value="1">Disponible</option>
          <option value="0">No disponible</option>
        </select>
      </div>
      <div class="campo-form">
        <label>Foto del Plato</label>
        <input type="file" name="foto" accept="image/*">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn-cancelar" id="cancelarAgregar">Cancelar</button>
        <button type="submit" class="btn-guardar">Guardar</button>
      </div>
    </form>
  </div>
</div>

{{-- === MODAL EDITAR === --}}
<div id="modalEditar" class="modal-overlay" style="display:none;">
  <div class="modal-contenido">
    <div class="modal-header">
      <h2>Editar Menú</h2>
      <button id="cerrarModalEditar" class="btn-cerrar">&times;</button>
    </div>

    <form action="{{ route('editar.menu') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <input type="hidden" name="id" id="idEditar">

      <div class="campo-form">
        <label>Nombre del Plato</label>
        <input type="text" id="nombreEditar" name="nombre" required>
      </div>
      <div class="campo-form">
        <label>Descripción</label>
        <input type="text" id="descripcionEditar" name="descripcion" required>
      </div>
      <div class="campo-form">
        <label>Precio (Bs)</label>
        <input type="number" id="precioEditar" name="precio" step="0.01" required>
      </div>
      <div class="campo-form">
        <label>Disponibilidad</label>
        <select id="disponibilidadEditar" name="disponibilidad" required>
          <option value="1">Disponible</option>
          <option value="0">No disponible</option>
        </select>
      </div>
      <div class="campo-form">
        <label>Foto del Plato (opcional)</label>
        <input type="file" name="foto" accept="image/*">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn-cancelar" id="cancelarEditar">Cancelar</button>
        <button type="submit" class="btn-guardar">Actualizar</button>
      </div>
    </form>
  </div>
</div>

<script>
// === Modal Agregar ===
const modalAgregar = document.getElementById('modalAgregar');
document.getElementById('abrirModalAgregar').onclick = () => modalAgregar.style.display = 'flex';
document.getElementById('cerrarModalAgregar').onclick = () => modalAgregar.style.display = 'none';
document.getElementById('cancelarAgregar').onclick = () => modalAgregar.style.display = 'none';

// === Modal Editar ===
const modalEditar = document.getElementById('modalEditar');
const botonesEditar = document.querySelectorAll('.btn-abrir-editar');

botonesEditar.forEach(boton => {
  boton.addEventListener('click', () => {
    document.getElementById('idEditar').value = boton.dataset.id;
    document.getElementById('nombreEditar').value = boton.dataset.nombre;
    document.getElementById('descripcionEditar').value = boton.dataset.descripcion;
    document.getElementById('precioEditar').value = boton.dataset.precio;
    document.getElementById('disponibilidadEditar').value = boton.dataset.disponibilidad;
    modalEditar.style.display = 'flex';
  });
});

document.getElementById('cerrarModalEditar').onclick = () => modalEditar.style.display = 'none';
document.getElementById('cancelarEditar').onclick = () => modalEditar.style.display = 'none';
</script>
@endsection
