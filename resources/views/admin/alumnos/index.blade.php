@extends('layouts.admin')

@section('titulo','Alumnos')
@section('direccion', 'Alumnos')

@section('contenido')
<div class="card  card-purple col-12">
	<div class="card-header">
		<h3 class="card-title">Listado de Alumnos</h3>
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
                    <th>NEE</th>
                    <th>Profesor</th>
					<th>Editar</th>
					<th>Eliminar</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($alumnos as $alumno)
					<tr>
						<td>{{$alumno->rut}}</td>
						<td>{{$alumno->nombres}}</td>
						<td>{{$alumno->apellidos}}</td>
						<td>{{$alumno->fnac}}</td>
						<td>{{$alumno->telefono}}</td>
                        <td>{{$alumno->email}}</td>
                        <td>{{$alumno->NEE}}</td>
                        <td>{{$alumno->profesores->nombres}}</td>
						<td><a href="{{Route('admin.editarProfesor',$alumno->id)}}" class="btn btn-warning"><i class="fa fa-edit" aria-hidden="true"></i></a></td>
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
