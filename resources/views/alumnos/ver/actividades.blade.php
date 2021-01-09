@extends('layouts.alumno')
@section('titulo', 'Inicio')

@section('contenido')

<h1 class="text-center uppercase text-bold">Listado de actividades</h1>

<div class="row">
	<div class="container">
		<div class="col-12">
			@foreach ($actividades as $key => $actividad)
			@if(!is_null($actividad->actividades))
			<a href="{{ Route('alumno.realizarAct', $actividad->actividades_id) }}">
				<div class="info-box bg-info">
					<span class="info-box-icon"><i class="far fa-calendar-alt"></i></span>
					<div class="info-box-content">
					<span class="info-box-text text-bold text-uppercase">{{ $actividad->actividades->nombre }}</span>
					<span class="info-box-number">Fecha Inicio : {{ date('d-m-Y', strtotime( $actividad->fecha_inicio )) }}</span>
					<span class="info-box-number">Fecha Termino : {{ date('d-m-Y', strtotime( $actividad->fecha_termino )) }}</span>
					<span class="progress-description">{{$actividad->actividades->subcategorias->categorias->nombre }}</span>
					</div>
				</div>
			</a>
			  @endif
			  @endforeach
		</div>
	</div>
	</div>
	{{-- <table class="table purple">
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
			@foreach ($actividades as $key => $actividad)
			@if(!is_null($actividad->actividades))
			<tr>
				<th scope="row">{{ $key + 1 }}</th>
				<td><a href="{{ Route('alumno.realizarAct', $actividad->actividades_id) }}">{{ $actividad->actividades->nombre }}</a></td>
				<td>{{$actividad->actividades->subcategorias->categorias->nombre }}</td>
				<td>{{ $actividad->fecha_inicio }}</td>
				<td>{{ $actividad->fecha_termino }}</td>
				<td>{{ $actividad->tiempo }}</td>
				<td >{{ $actividad->estado }}</td>
			</tr>
			@endif
			@endforeach
		</tbody>
	</table> --}}

		
@endsection