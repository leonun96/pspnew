@extends('layouts.alumno')
@section('titulo', 'Inicio')

@section('contenido')

<h1 class="text-center uppercase text-bold">Listado de actividades</h1>

<div class="row col-12">
	<table class="table purple">
		<thead class="thead-dark">
			<tr>
				<th scope="col">#</th>
				<th scope="col">Actividad</th>
				<th scope="col">Categoria</th>
				<th scope="col">Fecha inicio</th>
				<th scope="col">Fecha termino</th>
				<th scope="col">Tiempo para realizarla</th>
				<th scope="col">Estado</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($actividades as $actividad)
			@if(!is_null($actividad->actividades))
			<tr>
				<th scope="row">{{ $actividad->id }}</th>
				<td><a href="{{ Route('alumno.realizarAct', $actividad) }}">{{ $actividad->actividades->nombre }}</a></td>
				<td>{{$actividad->actividades->subcategorias->categorias->nombre }}</td>
				<td>{{ $actividad->fecha_inicio }}</td>
				<td>{{ $actividad->fecha_termino }}</td>
				<td>{{ $actividad->tiempo }}</td>
				<td >{{ $actividad->estado }}</td>
			</tr>
			@endif
			@endforeach
		</tbody>
	</table>
</div>
		
@endsection