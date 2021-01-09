@extends('layouts.alumno')
@section('titulo', 'Inicio')
@section('direccion', 'Resultado de evaluaciones')

@section('contenido')


<h1 class="text-center uppercase text-bold">Resultado de evaluaciones</h1>

<div class="row">
	@foreach ($resultados as $resultado)
	@if(!is_null($resultado->resultados) && !is_null($resultado->actividades))
	<div class="col-6">
		<div class="small-box bg-success justify-content-center">
			<div class="inner">
			  <h3>{{$resultado->resultados->nota ? $resultado->resultados->nota : '--'}}</h3>
			  <sup style="font-size: 20px">Puntaje: {{ $resultado->resultados->puntaje ? $resultado->resultados->puntaje : '--' }}</sup>
			  <h5 class="mt-2"> {{ $resultado->actividades->nombre }}</h5>
			  <small>{{ $resultado->actividades->subcategorias->categorias->nombre }}</small>
			</div>
			<div class="icon">
			  <i class="ion ion-stats-bars"></i>
			</div>
			<a href="{{route('alumno.detalles', $resultado->id)}}" class="small-box-footer">
			  Ver detalles <i class="fas fa-arrow-circle-right"></i>
			</a>
		</div>
	</div>
	@endif
	@endforeach
</div>
	



	{{-- <table class="table purple">
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
				<td>{{ $resultado->actividades->nombre }}</td>
				<td>{{ $resultado->actividades->subcategorias->categorias->nombre }}</td>
				<td>{{ $resultado->resultados->puntaje ? $resultado->resultados->puntaje : 'Por evaluar' }}</td>
				<td>{{  $resultado->resultados->nota ? $resultado->resultados->nota : 'Por evaluar' }}</td>
				<td>
					<a href="{{route('alumno.detalles', $resultado->id)}}" class="btn btn-outline-secondary">Ver detalles</a>
				</td>         
			</tr>
			@endforeach
		</tbody>
	</table> --}}
</div>
@endsection