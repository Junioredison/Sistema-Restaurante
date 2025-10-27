@extends('layout.navbar')

@section('titulo','Usuario')

@section('contenido') 
<link rel="stylesheet" href="{{ asset('css/generalTable.css') }}">

@if (session(key: 'autorizacion'))
<div class="alerta-error">
{{ session(key: 'autorizacion')}}
</div>
@endif       

    <main class="content">
    <div class="header-section">
      <h1>Gestión de Usuarios</h1>
      
      <a class="btn-add" href="{{ route('index.crear.usuario') }}">Agregar Usuario</a>
    </div>

    <table class="roles-table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Username</th>       
          <th>Email</th>
          <th>Rol</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>

        @foreach ($datos as $dato)
        <tr>
          <td>{{ $dato['id'] }}</td>
          <td>{{ $dato['usuario'] }}</td>
          <td>{{ $dato['email'] }}</td>
          <td>{{ $dato['rol'] }}</td>         
          <td class="acciones">
          <div style="display: flex; justify-content: center; align-items: center; gap: 10px;">
            <form action="{{ route('index.editar.usuario') }}" method="GET" style="margin: 0;">
              @csrf
              <input type="hidden" value="{{ $dato['id'] }}" name="id"> 
              <button class="btn-edit">Editar</button>
            </form>
            
            <form action="{{ route('eliminar.usuario') }}" method="POST" style="margin: 0;">
              @csrf
              <input type="hidden" value="{{ $dato['id'] }}" name="id"> 
              <button class="btn-delete">Eliminar</button>
            </form>
          </div>
        </td>
        </tr>       
        @endforeach

      </tbody>
    </table>
  </main>
@endsection
