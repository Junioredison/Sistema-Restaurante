@extends('layout.navbar')

@section('titulo', 'Gestión de Pedidos')

@section('contenido')
<link rel="stylesheet" href="{{ asset('css/generalTable.css') }}">

<main class="content">
  <div class="header-section">
    <h1>Gestión de Pedidos</h1>
    <button class="btn-add" id="abrirModalCrear">+ Nuevo Pedido</button>
  </div>

  @if (session('success'))
    <div class="alert alert-success text-center">{{ session('success') }}</div>
  @endif
  @if (session('error'))
    <div class="alert alert-danger text-center">{{ session('error') }}</div>
  @endif

<table class="roles-table">
  <thead>
    <tr>
      <th style="display: none;">ID</th>
      <th>Mesa</th>
      <th>Platos</th>
      <th>Total (Bs)</th>
      <th>Estado</th>
      <th>Acciones</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($pedidos as $pedido)
      <tr>
        <td style="display: none;">{{ $pedido->id }}</td>
        <td>{{ $pedido->mesa->numero_mesa ?? '—' }}</td>

        {{-- 🥘 Mostrar los platos del pedido --}}
        <td>
          <ul style="list-style:none; padding:0; margin:0;">
            @foreach ($pedido->detalles as $detalle)
              <li>
                {{ $detalle->menu->nombre }} 
                (x{{ $detalle->cantidad }})
                — Bs {{ number_format($detalle->subtotal, 2) }}
              </li>
            @endforeach
          </ul>
        </td>

        <td>{{ number_format($pedido->total, 2) }}</td>

        <td>
  <select class="estado-select" data-id="{{ $pedido->id }}">
    <option value="Pendiente" {{ $pedido->estado == 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
    <option value="Listo" {{ $pedido->estado == 'Listo' ? 'selected' : '' }}>Listo</option>
    <option value="Entregado" {{ $pedido->estado == 'Entregado' ? 'selected' : '' }}>Entregado</option>
  </select>
</td>


        <td>
          <form action="{{ route('eliminar.pedido') }}" method="POST" style="display:inline;">
            @csrf
            <input type="hidden" name="id" value="{{ $pedido->id }}">
            <button type="submit" class="btn-delete" onclick="return confirm('¿Seguro que deseas eliminar este pedido?')">
              Eliminar
            </button>
          </form>
        </td>
      </tr>
    @endforeach
  </tbody>
</table>
</main>

{{-- === MODAL CREAR PEDIDO === --}}
<div id="modalCrear" class="modal-overlay" style="display:none;">
  <div class="modal-contenido" style="max-width: 600px;">
    <div class="modal-header">
      <h2>Nuevo Pedido</h2>
      <button id="cerrarModalCrear" class="btn-cerrar">&times;</button>
    </div>

    <form action="{{ route('crear.pedido') }}" method="POST">
      @csrf

      <div class="campo-form">
        <label>Mesa:</label>
        <select name="mesa_id" required>
          <option value="">Seleccione una mesa</option>
          @foreach ($mesas as $mesa)
            <option value="{{ $mesa->id }}">Mesa {{ $mesa->numero_mesa }}</option>
          @endforeach
        </select>
      </div>

      <div class="campo-form">
        <label>Seleccione los platos:</label>
        <div id="listaMenus">
          @foreach ($menus as $menu)
            <div class="menu-item" style="display:flex;justify-content:space-between;align-items:center;margin-bottom:8px;">
              <label>
                <input type="checkbox" name="menus[{{ $menu->id }}][id]" value="{{ $menu->id }}">
                {{ $menu->nombre }} (Bs {{ number_format($menu->precio, 2) }})
              </label>
              <input type="number" name="menus[{{ $menu->id }}][cantidad]" value="1" min="1" style="width:60px;text-align:center;">
            </div>
          @endforeach
        </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn-cancelar" id="cancelarModal">Cancelar</button>
        <button type="submit" class="btn-guardar">Guardar Pedido</button>
      </div>
    </form>
  </div>
</div>

<script>
// === Modal Crear ===
const modal = document.getElementById('modalCrear');
document.getElementById('abrirModalCrear').onclick = () => modal.style.display = 'flex';
document.getElementById('cerrarModalCrear').onclick = () => modal.style.display = 'none';
document.getElementById('cancelarModal').onclick = () => modal.style.display = 'none';

// Cerrar modal al hacer clic fuera
window.addEventListener('click', e => {
  if (e.target === modal) modal.style.display = 'none';
});
</script>

<script>
// === CAMBIAR ESTADO DE PEDIDO ===
document.querySelectorAll('.estado-select').forEach(select => {
  select.addEventListener('change', async () => {
    const id = select.dataset.id;
    const estado = select.value;

    try {
      const res = await fetch("{{ route('cambiar.estado.pedido') }}", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
          "X-CSRF-TOKEN": "{{ csrf_token() }}"
        },
        body: JSON.stringify({ id, estado })
      });

      const data = await res.json();
      if (data.success) {
        select.style.border = "2px solid #00ff9f";
        setTimeout(() => (select.style.border = ""), 1000);
      }
    } catch (error) {
      alert("Error al cambiar el estado del pedido.");
    }
  });
});
</script>

@endsection
