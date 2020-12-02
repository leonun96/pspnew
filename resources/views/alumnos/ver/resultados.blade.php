@extends('layouts.alumno')
@section('titulo', 'Inicio')

@section('contenido')


<h1 class="text-center uppercase text-bold">Resultado de evaluaciones</h1>

<div class="row col-12">
    <table class="table purple">
        <thead class="thead-dark">
          <tr>
            <th scope="col">Actividad</th>
            <th scope="col">Categoria</th>
            <th scope="col">Puntaje</th>
            <th scope="col">Nota</th>
            <th scope="col">Ver detalles</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($resultados as $resultado)
          <tr>
            <td>{{ $resultado->actividadesAsignadas->actividades->nombre }}</td>
            <td>{{ $resultado->actividadesAsignadas->actividades->subcategorias->categorias->nombre }}</td>
            <td>{{ $resultado->puntaje ? $resultado->puntaje : 'Por evaluar' }}</td>
            <td>{{  $resultado->puntaje ? $resultado->puntaje : 'Por evaluar'  }}</td>
            <td><a href="{{route('alumno.detalles', $resultado->id)}}" class="btn btn-outline-secondary">Ver detalles</a></td>         
          </tr>
            @endforeach
        </tbody>
      </table>
</div>
@endsection