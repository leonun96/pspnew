@extends('layouts.profesor')

@section('titulo','Ver Actividades realizadas')
@section('direccion', 'Ver Actividades realizadas')

@section('contenido')
<div class="card  card-purple col-12">

	<div class="card-header">
		<h3 class="card-title">Listado de actividades realizadas</h3>
	</div>

	{{-- @if(session()->has('flash'))
	<br>
	<div class="container">
		<div class="alert alert-success">
			{{ session('flash') }}
		</div>
	</div>
	@endif --}}

	<div class="card-body">
		<table id="tabla-actividades" class="table table-bordered table-striped">
			<thead>
			<tr>
				<th>Nº</th>
				<th>Actividad</th>
				<th>Alumno</th>
			</tr>
			</thead>
			<tbody>
				
			</tbody>
		</table>
	</div>
</div>



@endsection

@section('scripts')
	
@endsection

			 