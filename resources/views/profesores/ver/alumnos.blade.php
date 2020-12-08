
@extends('layouts.profesor')

@section('titulo','Ver alumnos')
@section('direccion', 'Ver Alumnos')

@section('contenido')
<div class="card  card-purple col-12">

	<div class="card-header">
		<h3 class="card-title">Listado de alumnos</h3>
	</div>

	@if(session()->has('flash'))
	<br>
	<div class="container">
		<div class="alert alert-success">
			{{ session('flash') }}
		</div>
	</div>
	@endif

	@if(session()->has('flash-deleted'))
	<br>
	<div class="container">
		<div class="alert alert-danger">
			{{ session('flash-deleted') }}
		</div>
	</div>
	@endif

	@if(session()->has('flash-edit'))
	<br>
	<div class="container">
		<div class="alert alert-warning">
			{{ session('flash-edit') }}
		</div>
	</div>
	@endif

	<div class="card-body">
		<table id="tabla-alumnos" class="table table-bordered table-striped">
			<thead>
			<tr>
				<th>Rut</th>
				<th>Nombres</th>
				<th>Apellidos</th>
				<th>Fecha de Nacimiento</th>
				<th>Telefono</th>
				<th>Email</th>
				<th>NEE</th>
				<th>Eliminar</th>
				<th>Editar</th>
				<th>Diagnosticos</th>
				
			</tr>
			</thead>
			<tbody>
				@foreach ($alumnos as $alumno)
				<tr>
					<td>{{ $alumno->rut }}</td>
					<td>{{ $alumno->nombres }}</td>
					<td>{{ $alumno->apellidos }}</td>
					<td>{{ $alumno->fnac }}</td>
					<td>{{ $alumno->telefono }}</td>
					<td>{{ $alumno->email }}</td>
					<td>{{ $alumno->NEE }}</td>
					<td>
						<form method="POST" action="{{ route('profesor.eliminarAlumno',$alumno->id) }}">
							@csrf
							@method('DELETE')
							<button type="submit" class="btn btn-block btn-outline-danger eliminar" name="eliminar">
								<i class="fa fa-trash" aria-hidden="true"></i>Eliminar
							</button>
						</form>
					</td>
					<td>
						<button type="submit" class="btn btn-block btn-outline-warning" data-toggle="modal" data-target="#moda-{{ $alumno->id }}">
							<i class="fa fa-edit" aria-hidden="true"></i>Editar
						</button>
					</td>
					<td>
						<button type="submit" class="btn btn-block btn-outline-success" data-toggle="modal" data-target="#moda2-{{ $alumno->id }}">
							<i class="fas fa-stethoscope"></i>Diagnosticos
						</button>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>


@foreach ($alumnos as $alumno)
<div class="modal fade" id="moda-{{ $alumno->id }}">
	<div class="modal-dialog">
		<div class="modal-content bg-purple">
			<div class="modal-header">
				<h4 class="modal-title">Editar alumno/a {{ $alumno->nombres }} {{ $alumno->apellidos }}</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body">
				<form action="{{ route('profesor.editarAlumno',$alumno->id) }}" method="POST">
					{{ csrf_field() }}
						<div class="card-body">
							<div class="form-group">
								<label for="rut">RUT</label>
								<input type="text" class="form-control" name="rut" value="{{ $alumno->rut }}" placeholder="Ingrese el RUT del alumno">
							</div>
							<div class="form-group">
								<label for="nombres">Nombres</label>
								<input type="text" class="form-control" name="nombres" value="{{ $alumno->nombres }}" placeholder="Ingrese el nombre del alumno">
							</div>
							<div class="form-group">
								<label for="apellidos">Apellidos</label>
								<input type="text" class="form-control" name="apellidos" value="{{ $alumno->apellidos }}" placeholder="Ingrese apellidos del alumno">
							</div>
							<div class="form-group">
								<label for="fnac">Fecha nacimiento</label>
								<input type="date" class="form-control" name="fnac"  value="{{ $alumno->fnac }}">
							</div>
							<div class="form-group">
								<label for="telenfono">Telefono</label>
								<input type="text" class="form-control" name="telefono" value="{{ $alumno->telefono }}" placeholder="Ingrese telefono del alumno" >
							</div>
							<div class="form-group">
								<label for="email">Email</label>
								<input type="email" class="form-control" name="email"  value="{{ $alumno->email }}" placeholder="Ingrese email del alumno">
							</div>
							<div class="form-group">
								<label>Diagnostico a Necesidades Educativas Especiales</label>
									<select class="custom-select" name="diagnostico">
										<option value="{{ $alumno->NEE }}"> {{ $alumno->NEE }} </option>
										<option value="">------------------------------------------------</option>
										<option> NEE de tipo permanente</option>
										<option> NEE de tipo transitoria</option>
									</select>
							</div>
							<div class="form-group">
								<label>Profesor</label>
									<select class="custom-select" name="profesor_id">
										<option value="{{ $alumno->profesores->id }}"> {{ $alumno->profesores->rut}} {{ $alumno->profesores->nombres }} </option>
									</select>
							</div>
						</div>        
						<div class="card card-footer">
							<button type="submit" class="btn btn-success">Editar</button>
						</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endforeach

{{-- FIN MODAL EDITAR  --}}

{{-- INICIO MODAL DIAGNOSTICOS  --}}

@foreach ($alumnos as $alumno)
<div class="modal fade" id="moda2-{{ $alumno->id }}">
	<div class="modal-dialog">
		<div class="modal-content bg-purple">
			<div class="modal-header">
				<h4 class="modal-title">Historial de Diagnosticos de: {{ $alumno->nombres }} {{ $alumno->apellidos }}</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body">
				<div class="card-body">
					@php
					$diagnosticos = DB::table('diagnosticos')
					->where('alumnos_id',$alumno->id)
					->get();

					@endphp

					@foreach ($diagnosticos as $diagnostico)
					<p>{!! $diagnostico->diagnostico !!}</p>
					@endforeach
				</div>        
				<div class="card card-footer">
				<a href="{{ route('profesor.nuevoDiagnostico',$alumno->id) }}" class="btn btn-success">Nuevo Diagnostico</a>
				</div>
			</div>
		</div>
	</div>
</div>
@endforeach

@endsection

@section('scripts')
		<script>
		$('.eliminar').click(function(e) {
				if(!confirm('¿Seguro deseas eliminar al alumno?')) {
						e.preventDefault();
				}
		});
		</script>
@endsection

			 