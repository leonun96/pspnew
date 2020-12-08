@extends('layouts.profesor')

@section('titulo','Ver Actividades')
@section('direccion', 'Ver Actividades')

@section('contenido')
<div class="card  card-purple col-12">

	<div class="card-header">
		<h3 class="card-title">Listado de actividades</h3>
	</div>

	@if(session()->has('flash'))
	<br>
	<div class="container">
		<div class="alert alert-success">
			{{ session('flash') }}
		</div>
	</div>
	@endif

	<div class="card-body">
		<table id="tabla-actividades" class="table table-bordered table-striped">
			<thead>
			<tr>
				<th>Nº</th>
				<th>Actividad</th>
				<th>Sub categoria / Categoria</th>
				<th>Nivel</th>
				<th>Editar</th>
				<th>Asignar actividad</th>
				<th>Eliminar</th>
			</tr>
			</thead>
			<tbody>
				@foreach ($actividades as $act)
				<tr>
					<td>{{ $act->id }}</td>
					<td>{{ $act->nombre }}</td>
					<td>{{ $act->subcategorias->nombre }}, {{ $act->subcategorias->categorias->nombre }}</td>
					<td>{{ $act->niveles->nivel }}</td>
					<td>
						<button type="button" class="btn btn-block btn-outline-warning">
							<i class="fas fa-eye"></i>
						</button>
					</td> 
					<td>
						<button type="button" class="btn btn-block btn-outline-success" data-toggle="modal" data-target="#modal-{{ $act->id }}">
							<i class="fas fa-file-signature"></i>
						</button>
					</td> 
					<td>
						<a class="btn btn-danger btn-sm" href="{{ route('profesor.eliminar.actividad', $act->id) }}">
							<i class="fas fa-trash"></i>
						</a>
					</td>
				</tr>  
			 @endforeach
			</tbody>
		</table>
	</div>
</div>

@foreach ($actividades as $act)
<div class="modal fade" id="modal-{{ $act->id }}">
	<div class="modal-dialog">
		<div class="modal-content bg-purple">
			<div class="modal-header">
				<h4 class="modal-title">Asignar Actividad </h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body">
				<form action="{{ route('profesor.asignarActividad',$act->id)}}" method="POST">
				@csrf
				@method('PUT')
					<div class="row">
						<div class="col">
							<label for="desde">Desde</label>
						  <input type="date" class="form-control" name="desde" placeholder="Desde">
						</div>
						<div class="col">
							<label for="hasta">Hasta</label>
						  <input type="date" class="form-control" name="hasta" placeholder="Hasta">
						</div>
					</div>
					<div class="col mt-1">
						<label for="tiempo">Tiempo en minutos</label>
						<input type="number" class="form-control" name="tiempo" placeholder="tiempo">
					</div>
					<h5 class="text-center uppercase text-bold mt-2">Listado de alumnos</h5>
					@foreach ($alumnos as $alumno)
					<div class="input-group mb-2 mt-2">
						<div class="input-group-prepend">
							<div class="input-group-text">
								<input type="checkbox" aria-label="Checkbox for following text input" name="alumnos_id[]" value="{{$alumno->id}}">
							</div>
						</div>
						<input type="text" class="form-control text-center uppercase text-bold " 
						value="{{$alumno->nombres}} {{$alumno->apellidos}}" readonly>
					</div>
					@endforeach
					<input type="submit" name="asignar">
				</form>
			</div>
		</div>
	</div>
</div>
@endforeach

@endsection

			 