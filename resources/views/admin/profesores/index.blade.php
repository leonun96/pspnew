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
					<th>NEE</th>
					<th>Eliminar</th>
					<th>Editar</th>
					<th>Diagnosticos</th>
				</tr>
			</thead>
			<tbody>
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

			 