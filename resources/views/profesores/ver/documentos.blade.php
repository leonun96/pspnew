
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
		<div class="alert alert-success">
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
					<td><a href="" data-toggle="modal" data-target="#modal-{{$doc->id}}" class="btn btn-block btn-outline-success">Asignar</a></td>
						<td><a href="" class="btn btn-block btn-outline-danger">Eliminar</a></td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
	</div>

</div>



<div class="modal fade" id="modal-{{$doc->id}}">
	<div class="modal-dialog">
		<div class="modal-content bg-purple">
			<div class="modal-header">
				<h4 class="modal-title">Asignar documento </h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body">
			<form action="{{Route('profesor.asignarDoc', $doc->id)}}" method="POST">
				@csrf
				@method('PUT')
				<h5 class="text-center uppercase text-bold mt-2">Listado de alumnos</h5>
					@foreach ($alumnos as $alumno)
					<div class="input-group mb-2 mt-2">
						<div class="input-group-prepend">
						  <div class="input-group-text">
							<input type="checkbox" aria-label="Checkbox for following text input"
							name="alumnos_id[]" value="{{$alumno->id}}">
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





@endsection

@section('scripts')
	
@endsection

			 