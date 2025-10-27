@extends('layout.navbar')

@section('titulo','Crear Rol')

@section('contenido')
<link rel="stylesheet" href="{{ asset('css/crear.css') }}">

<main class="content">
  <div class="form-container">
    <h2>Editar Rol</h2>

      @if (session(key: 'error'))
        <div class="alerta-error">
            {{ session(key: 'error')}}
        </div>
    @endif 

    <form action="{{ route('editar.rol') }}" method="POST"> 
      @csrf

      <div class="form-group">
        <label for="nombre">Nombre del Rol</label>
        <input type="text" id="nombre" name="nombre" value="{{ $dato->nombre }}" placeholder="Nombre del rol" required>
      </div>
      <input type="hidden" value="{{ $dato->id }}" name="id"> 
      <div class="form-actions">
        <button type="submit" class="btn-guardar">Modificar</button>
        <a href="{{ route('mostrar.rol') }}" class="btn-cancelar">Cancelar</a>
      </div>
    </form>
  </div>
</main>
@endsection
