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
						<button type="button" class="btn btn-block btn-outline-warning" data-toggle="modal" data-target="#modal2-{{ $act->id }}">
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
@php
$asignadas = $act->asignadas;
// dump($asignadas);
@endphp
<div class="modal fade" id="modal-{{ $act->id }}">
	<div class="modal-dialog">
		<div class="modal-content bg-purple">
			<div class="modal-header">
				<h4 class="modal-title">Asignar Actividad {{ $act->nombre }}</h4>
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
							<input type="date" class="form-control" name="desde" placeholder="Desde" value="{{ date('Y-m-d') }}">
						</div>
						<div class="col">
							<label for="hasta">Hasta</label>
							<input type="date" class="form-control" name="hasta" placeholder="Hasta">
						</div>
					</div>
					<div class="col mt-1" hidden>
						<label for="tiempo">Tiempo en minutos</label>
						<input type="number" class="form-control" name="tiempo" value="90" readonly placeholder="tiempo">
					</div>
					<h5 class="text-center uppercase text-bold mt-2">Listado de alumnos</h5>
					@foreach ($alumnos as $alumno)
					@php
					$res = $asignadas->where('alumnos_id', $alumno->id)->count();
					// dump($res);
					@endphp
					<div class="input-group mb-2 mt-2">
						<div class="input-group-prepend">
							<div class="input-group-text">
								<input type="checkbox" aria-label="Checkbox for following text input" name="alumnos_id[]" value="{{$alumno->id}}" {{ ($res > 0) ? 'checked' : '' }}>
							</div>
						</div>
						<input type="text" class="form-control text-center uppercase text-bold " 
						value="{{$alumno->nombres}} {{$alumno->apellidos}}" readonly>
					</div>
					@endforeach
					<input type="submit" name="asignar" class="btn btn-success">
				</form>
			</div>
		</div>
	</div>
</div>
@endforeach

@foreach ($actividades as $act)
<div class="modal fade" id="modal2-{{ $act->id }}">
	<div class="modal-dialog">
		<div class="modal-content bg-purple">
			<div class="modal-header">
				<h4 class="modal-title">Editar Actividad </h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
			</div>
			<form method="POST" action="{{ route('profesor.editarActividad', $act->id) }}" enctype="multipart/form-data">
				@csrf
				@method('PUT')
				<div class="card-body">
					<div class="row mb-2">
						<div class="from-group col-12">
							<label for="nombre">Nombre de actividad</label>
							<input type="text" class="form-control" name="nombre" value="{{ $act->nombre}}">
						</div>
					</div>
					<div class="row">
						<div class="form-group col-4">
							<label for="categorias">Categoria</label>
							<select name="categorias" class="form-control categorias" id="categorias">
									<option value="{{ $act->subcategorias->categorias->id}}">{{ $act->subcategorias->categorias->COD}} - {{ $act->subcategorias->categorias->nombre}}</option>
								@foreach ($categorias as $categoria)
								<?php
									if($act->subcategorias->categorias->id != $categoria->id){
								?>
									<option value="{{ $categoria->id }}">{{ $categoria->COD }} - {{ $categoria->nombre }} </option>
								<?php
									}
								?>	
								@endforeach
							</select>
						</div>
						<div class="form-group col-4">
							<label for="subcategoria">Sub-Categoria</label>
							<select name="subcategorias" class="form-control subcategorias" >
								@foreach ($subcategorias as $sub)
									@if ($sub->categorias_id == $act->subcategorias->categorias->id)

									<option value="{{$sub->id }}" {{ $sub->id == $act->subcategorias_id ? 'selected' : '' }}> {{ $sub->nombre }}</option>

									@endif
								@endforeach
							{{-- <option value="{{ $act->subcategorias->id}}">{{ $act->subcategorias->nombre}}</option> --}}
							</select>
						</div>
						<div class="form-group col-4">
							<label for="nivel">Nivel</label>
							<select name="nivel" class="form-control" id="nivel">
							<option value="{{ $act->niveles->id}}">{{ $act->niveles->nivel}}</option>
							@foreach ($niveles as $nivel)
							<?php
							
								if($nivel->id != $act->niveles->id ){
							?>
								<option value="{{ $nivel->id }}"> {{ $nivel->nivel }}</option>
							<?php
								}
							?>	
							@endforeach
						</select>
						</div>
					</div>
					<div class="card card-footer">
						<button type="submit" class="btn btn-success boton" name="">Editar actividad</button>
					<a href="{{ Route('profesor.agregarPreguntas', $act->id ) }}" class="btn btn-success mt-2">Editar preguntas</a>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
@endforeach

@endsection

@section('scripts')
	<script>

		$(function(){
			$('.categorias').on('change',obtenerSubcate);
		});

		function obtenerSubcate(){
			var id = $(this).val();
			// AJAX
			$.get('/api/subcategoria/'+id,function (data){
				var html_select = '<option value="">Seleccion una subcategoria</option>';

				for(var i=0; i<data.length; i++)
				html_select += '<option value="'+data[i].id+'">'+data[i].nombre+'</option>';
				
				$('.subcategorias').html(html_select);
			});
			console.log($(this));
		}

	</script>
@endsection

			 