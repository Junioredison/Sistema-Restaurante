@extends('layout.navbar')

@section('titulo', 'mesa')

@section('contenido')

<link rel="stylesheet" href="{{ asset('css/generalTable.css') }}">

@if (session('autorizacion'))
    <div class="alerta-error">
        {{ session('autorizacion') }}
    </div>
@endif    



<main class="content">
    <div class="header-section">
        <h1 style="color: #f8f9fa">Gestión de Mesas</h1>    
        <button class="btn-add" id="abrirModalCrear">Agregar Mesa</button>  
    </div>

    <div class="table-container">
        <table class="roles-table">
            <thead>
                <tr>
                    <th style="display: none;">ID</th>
                    <th>Mesa</th> 
                    <th>Capacidad</th> 
                    <th>Disponibilidad</th> 
                    <th>Acciones</th> 
                </tr>
            </thead>
            <tbody>
            @foreach ($datos as $dato)
            <tr>
                <td style="display: none;">{{ $dato->id }}</td>
                <td>{{ $dato->numero_mesa }}</td>   
                <td>{{ $dato->capacidad }}</td>

                <td>
                    @if ($dato->disponibilidad == 1)
                        <span style="background-color:#00e078;color:white;padding:4px 10px;border-radius:8px;font-weight:bold;font-size:0.9rem;">
                            Disponible
                        </span>
                    @else
                        <span style="background-color:#dc3545;color:white;padding:4px 10px;border-radius:8px;font-weight:bold;font-size:0.9rem;">
                            No disponible
                        </span>
                    @endif    
                </td>   
                <td class="acciones">
    <button class="btn-edit btn-abrir-editar"
        data-id="{{ $dato->id }}"
        data-numero_mesa="{{ $dato->numero_mesa }}"
        data-capacidad="{{ $dato->capacidad }}"
        data-disponibilidad="{{ $dato->disponibilidad }}">
        Editar
    </button>

    <button class="btn-delete btn-abrir-eliminar"
        data-id-Eliminar="{{ $dato->id }}">
        Eliminar
    </button>
</td>

            </tr> 
            @endforeach
            </tbody>
        </table>
    </div>
</main>

{{-- === VENTANA MODAL CREAR === --}}
<div id="modalCrear" class="modal-overlay" style="display: none;">
  <div class="modal-contenido">
    <div class="modal-header">
      <h2>Agregar Mesa</h2>
      <button id="cerrarModalCrear" class="btn-cerrar">&times;</button>
    </div>

    <form action="{{ route('crear.mesa') }}" method="POST">
      @csrf

      <div class="campo-form">
        <label for="numero">Número de mesa:</label>
        <input type="text" id="numero_mesa" name="numero_mesa" required>
      </div>

      <div class="campo-form">
        <label for="capacidad">Capacidad (capacidad de personas):</label>
        <input type="number" id="capacidad" name="capacidad" min="1" required>
      </div>

      <div class="campo-form">
        <label for="disponibilidad">Disponibilidad:</label>
        <select id="disponibilidad" name="disponibilidad" required>
          <option value="1">Disponible</option>
          <option value="0">Ocupada</option>
        </select>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn-cancelar" id="cancelarModal">Cancelar</button>
        <button type="submit" class="btn-guardar">Guardar</button>
      </div>
    </form>
  </div>
</div>



{{-- ventana modal editar --}}
<div id="modalEditar" class="modal-overlay" style="display:none" >
    <div class="modal-contenido">
        <div class="modal-header">
            <h2 style="color: black">Editar mesa</h2>
            <button id="cerrarModalEditar" class="btn-cerrar">&times;</button>
        </div>

        <form action="{{ route('editar.mesa') }}" method="POST">
            @csrf

            <div class="campo-form">
                <label for="numero">Número de mesa:</label>
                <input type="text" id="numero_mesa" name="numero_mesa" required>
            </div>

            <div class="campo-form">
                <label for="capacidad">Cantidad de mesa:</label>
                <input type="number" id="capacidad" name="capacidad" required min="1">
            </div>

           
            <div class="campo-form">
                <label for="disponibilidad">Disponibilidad:</label>
                <select id="disponibilidad" name="disponibilidad" required>
                    <option value="1">Disponible</option>
                    <option value="0">Ocupada</option>
                </select>
            </div>

            <input type="hidden" name="id" id="id">

            <div class="modal-footer">
                <button type="button" class="btn-cancelar" id="cancelarEditar">Cancelar</button>
                <button type="submit" class="btn-guardar">Guardar</button>
            </div>
        </form>
    </div>
</div>


{{-- ventana modal eliminar --}}
<div id="modalEliminar" class="modal-overlay" style="display:none" >
    <div class="modal-contenido">
        <div class="modal-header">
            <h2 style="color: black">Eliminar mesa</h2>
            <button id="cerrarModalEliminar" class="btn-cerrar">&times;</button>
        </div>
            <span>¿Seguro que desea eliminar la mesa?</span>
       

        <form action="{{ route('eliminar.mesa') }}" method="POST">
            @csrf
            <input type="hidden" name="inputIdEliminar" id="inputIdEliminar">

            <div class="modal-footer">
                <button type="button" class="btn-cancelar" id="cancelarEliminar">Cancelar</button>
                <button type="submit" class="btn-guardar">Eliminar</button>
            </div>
        </form>
    </div>
</div>

<script>

    /* === Modal Crear === */
    const modal = document.getElementById('modalCrear');
    const cerrarmodal = document.getElementById('cerrarModalCrear');
    const cancelarModal = document.getElementById('cancelarModal');
    const abrirModalCrear = document.getElementById('abrirModalCrear');

    cerrarmodal.addEventListener('click',()=>modal.style.display= 'none');
    cancelarModal.addEventListener('click',()=>modal.style.display= 'none');
    abrirModalCrear.addEventListener('click',()=>modal.style.display= 'flex');

    /* === Modal Eliminar === */
    const modalEliminar = document.getElementById('modalEliminar');
    const cerrarEliminar = document.getElementById('cerrarModalEliminar');
    const cancelarEliminar = document.getElementById('cancelarEliminar');   
    const botonesEliminar = document.querySelectorAll('.btn-abrir-eliminar');

    
    botonesEliminar.forEach(boton => {
        boton.addEventListener('click', () => {
            // obtener los datos desde los atributos del botón
            const id = boton.getAttribute('data-id-Eliminar');            

            // llenar los campos del formulario
            inputIdEliminar.value= id ;

            // mostrar el modal
            modalEliminar.style.display = 'flex';
        });
    });


    cerrarEliminar.addEventListener('click',()=>modalEliminar.style.display= 'none');
    cancelarEliminar.addEventListener('click',()=>modalEliminar.style.display= 'none');
   


    /* === Modal Editar === */
    const modalEditar = document.getElementById('modalEditar');
    const cerrarEditar = document.getElementById('cerrarModalEditar');
    const cancelarEditar = document.getElementById('cancelarEditar');

    // campos del formulario dentro del modal editar
    const inputNumero = modalEditar.querySelector('input[name="numero_mesa"]');
    const inputId = modalEditar.querySelector('input[name="id"]');
    const inputCantidad = modalEditar.querySelector('input[name="capacidad"]');
    const selectDisponibilidad = modalEditar.querySelector('select[name="disponibilidad"]');
    const formEditar = modalEditar.querySelector('form');

    // todos los botones "Editar" de la tabla
    const botonesEditar = document.querySelectorAll('.btn-abrir-editar');

    botonesEditar.forEach(boton => {
        boton.addEventListener('click', () => {
            // obtener los datos desde los atributos del botón
            const id = boton.getAttribute('data-id');
            const numero_mesa = boton.getAttribute('data-numero_mesa');
            const capacidad = boton.getAttribute('data-capacidad');
            const disponibilidad = boton.getAttribute('data-disponibilidad');

            // llenar los campos del formulario
            inputNumero.value = numero_mesa;
            inputCantidad.value = capacidad;
            selectDisponibilidad.value = disponibilidad;
            inputId.value= id ;
            // mostrar el modal
            modalEditar.style.display = 'flex';
        });
    });

    // botones para cerrar/cancelar
    cerrarEditar.addEventListener('click', () => modalEditar.style.display = 'none');
    cancelarEditar.addEventListener('click', () => modalEditar.style.display = 'none');

    // cerrar si hace clic fuera del modal
    window.addEventListener('click', (e) => {
        if (e.target === modalEditar) modalEditar.style.display = 'none';
        if (e.target === modalCrear) modalCrear.style.display = 'none';
    });


</script>

@endsection


