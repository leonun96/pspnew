
@extends('layouts.profesor')

@section('titulo','Ver documentos')
@section('direccion', 'Ver documentos')

@section('contenido')
<div class="card  card-purple col-12">

	<div class="card-header">
		<h3 class="card-title">Listado de documentos</h3>
	</div>

	@if(session()->has('flash'))
	<br>
	<div class="container">
		<div class="alert alert-danger">
			{{ session('flash') }}
		</div>
	</div>
	@endif

	<div class="row">
		<div class="card-body">
			<table id="tabla-alumnos" class="table table-bordered table-striped">
				<thead>
				<tr>
					<th>Id</th>
					<th>Archivo</th>
					<th>Asignar</th>	
					<th>Eliminar</th>	
				</tr>
				</thead>
				<tbody>
					@foreach ($documentos as $doc)
					<tr>
						<td>{{$doc->id}}</td>
						<td>{{$doc->ruta}}</td>
						<td><a href="">Asignar</a></td>
						<td><a href="">Eliminar</a></td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
	</div>

</div>

@endsection

@section('scripts')
	
@endsection

			 