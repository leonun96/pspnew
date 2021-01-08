@extends('layouts.admin')

@section('titulo','Profesores')
@section('direccion', 'Profesores')

@section('contenido')
<div class="card  card-purple col-12">
	<div class="card-header">
		<h3 class="card-title">Listado de profesores</h3>
	</div>
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
					<th>Editar</th>
					<th>Eliminar</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($profesores as $profe)
					<tr>
						<td>{{$profe->rut}}</td>
						<td>{{$profe->nombres}}</td>
						<td>{{$profe->apellidos}}</td>
						<td>{{$profe->fnac}}</td>
						<td>{{$profe->telefono}}</td>
						<td>{{$profe->email}}</td>
						<td><a href="{{Route('admin.editarProfesor',$profe->id)}}" class="btn btn-warning"><i class="fa fa-edit" aria-hidden="true"></i></a></td>
						<td><a href="" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>

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

			 