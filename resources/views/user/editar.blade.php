@extends('layout.navbar')

@section('titulo','Roles')

@section('contenido')
<link rel="stylesheet" href="{{asset('css/crear.css') }}">

<main class="content">
  <div class="form-container">
    <h2>Editar usuario</h2>

    @if (session('error'))
            <div class="alerta-error">
                <span class="block"> {{ session('error') }}</span>
            </div>
        @endif 

    <form action="{{ route('editar.usuario') }}" method="POST"> 
      @csrf

      <div class="form-group">
        <label for="nombre">Username:</label>
        <input type="text" id="nombre" name="username" value="{{ $dato->username }}" required>
      </div>
      <div class="form-group">
        <label for="nombre">Correo:</label>
        <input type="email" id="nombre" name="email" value="{{ $dato->email }}" required>
      </div>
    
      <div class="form-group">
        <label for="nombre">Rol id:</label>
        <input type="number" id="nombre" name="rol_id" value="{{ $dato->rol_id }}" required>
      </div>

      <input type="hidden" value="{{ $dato->id }}" name="id"> 
      <div class="form-actions">
        <button type="submit" class="btn-guardar">Modificar</button>
        <a href="{{ route('mostrar.usuario') }}" class="btn-cancelar">Cancelar</a>
      </div>
    </form>
  </div>
</main>
@endsection
