@extends('layout.navbar')

@section('titulo','Crear Roles')

@section('contenido')
<link rel="stylesheet" href="{{ asset('css/crear.css') }}">

<main class="content">
  <div class="form-container">
    <h2>Agregar</h2>

    @if (session('error'))
        <div class="alerta-error">
            <span class="block">{{ session('error') }}</span>
        </div>
    @endif

    <form action="{{ route('crear.usuario') }}" method="POST" enctype="multipart/form-data">
      @csrf

      <div class="form-group">
        <label for="nombre">Username</label>
        <input type="text" id="username" name="username"  required>
      </div>
      <div class="form-group">
        <label for="nombre">Correo</label>
        <input type="email" id="email" name="email" required>
      </div>
      <div class="form-group">
        <label for="nombre"> Contraseña:</label>
        <input type="password" id="password" name="password" required>
      </div>
      <div class="form-group">
        <select name="rol_id" id="">
          @foreach ($roles as  $rol)
                    <option value={{ $rol->id }}>{{$rol->nombre }}</option>
                @endforeach
        </select>
      </div>

      <div class="form-actions">
        <button type="submit" class="btn-submit">Guardar</button>
        <a href="{{ route('mostrar.usuario') }}" class="btn-cancelar">Cancelar</a>
      </div>
    </form>
  </div>
</main>
@endsection
