@extends('layouts.profesor')
@section('titulo','Agregar Preguntas')
@section('direccion', 'Agregar preguntas a actividad')

@section('estilos')
@endsection

@section('contenido')

@foreach ($actividad as $actividades)
@endforeach

<style>

</style>

<div class="card card-purple col-6">
	<div class="card-header">
		<h3 class="card-title">Agregar preguntas a la actividad "{{ $actividad->nombre }}"</h3>
	</div>
	<form method="POST" action="{{ route('profesor.nuevaPregunta', $actividad->id) }}" enctype="multipart/form-data">
		@csrf
		@method('PUT')
		<div class="card-body">
			<div class="row">
				<div class="form-group col-3">
					<label for="actividad"> NºActividad</label>
					<input type="text" class="form-control" name="actividad" value="{{ $actividad->id}}" readonly disabled>
				</div>
				<div class="form-group col-3">
					<label for="categoria">Categoria</label>
					<input type="text" class="form-control" name="categoria" value="{{ $actividad->subcategorias->categorias->nombre}}"readonly disabled >
				</div>
				<div class="form-group col-3">
					<label for="subcategoria">Sub-Categoria</label>
					<input type="text" class="form-control" name="subcategoria" value="{{ $actividad->subcategorias->nombre}}"readonly disabled >
				</div>
				<div class="form-group col-3">
					<label for="pregunta">Nivel</label>
					<input type="text" class="form-control" name="nivel" value="{{ $actividad->niveles->nivel }}" readonly disabled>
				</div>
			</div>

			<div class="form-group">
				<label for="pregunta">Pregunta</label>
				<input type="text" class="form-control" name="pregunta" value="{{ old('pregunta') }}">
			</div>
			{{-- <div class="form-group">
				<label for="imagen">Seleccione imagen de referencia (Opcional)</label>
				<input type="file" name="imagen" >
			</div> --}}
			<div class="form-group">
				<label class="col-form-label" for="inputSuccess"><i class="fas fa-check"></i>Respuesta Correcta</label>
				<input type="text" class="form-control is-valid" id="inputSuccess" name="correcta">
			</div>
			<div class="form-group">
				<label class="col-form-label" for="inputError"><i class="far fa-times-circle"></i>Respuesta Incorrecta</label>
				<input type="text" class="form-control is-invalid" id="inputError" name="incorrecta1" >
			</div>
			<div class="form-group">
				<label class="col-form-label" for="inputError"><i class="far fa-times-circle"></i>Respuesta Incorrecta</label>
				<input type="text" class="form-control is-invalid" id="inputError" name="incorrecta2" >
			</div>
			<div class="form-group">
				<label class="col-form-label" for="inputError"><i class="far fa-times-circle"></i>Respuesta Incorrecta</label>
				<input type="text" class="form-control is-invalid" id="inputError" name="incorrecta3">
			</div>
			<div class="card card-footer">
				<button type="submit" class="btn btn-success boton" name="">Agregar pregunta</button>
			</div>
		</form>
		</div>
</div>

<div class="card card-purple col-6">

	<div class="card-header">
		<h3 class="card-title">Previsualización "{{ $actividad->nombre }}"</h3>
	</div>

	<div class="card card-body">
	<form action="{{ route('profesor.editarPreguntas',$actividad->id) }}" method="POST">
			@csrf
			@method('PUT')
			@foreach ($actividad->preguntas as $pregunta)
			<div class="row">
				<div class="col">
					<label for="pregunta" class="mt-2">Pregunta</label>
					<input type="text" id="pregunta" name="pregunta[{{ $pregunta->id }}]" class="form-control mb-2 border-0" value="{{ $pregunta->pregunta }}">
				</div>
				<button type="button" class="btn btn-block btn-outline-success" data-toggle="modal" data-target="#moda-{{ $pregunta->id }}">
					Editar Respuestas
				</button>
				<a href="{{ Route('profesor.eliminarPregunta' , $pregunta->id) }}" class="btn btn-block btn-outline-danger">Eliminar</a>
			</div>
			@endforeach
			<div class="row mt-2">
				<button type="submit" class="btn btn-outline-secondary mt-3 btn-block">Editar Preguntas</button>
			</div>
		</form>
	</div>

	<div class="card card-footer">
		<a href="{{ route('profesor.menu') }}" class="btn btn-success">Finalizar actividad</a>
	</div>
	
</div>




@foreach ($actividad->preguntas as $pregunta)
{{-- MODAL RESPUESTAS --}}
<div class="modal fade" id="moda-{{ $pregunta->id }}">
	<div class="modal-dialog">
	  <div class="modal-content bg-purple">
		<div class="modal-header">
		  <h4 class="modal-title">{{ $pregunta->pregunta }}</h4>
		  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span></button>
		</div>
		<div class="modal-body">
				@foreach ($pregunta->respuestas as $res)
				<form action="{{ Route('profesor.editarRespuesta', $pregunta->id) }}" method="POST">
				@csrf
				@method('PUT')
				<div class="row">
					<div class="form-group col-12">
						<label for="respuesta">Respuesta</label>
					<input 
						type="text" 
						name="respuesta[{{$res->id}}]" 
						id="respuesta" 
						class="form-control {{ $res->correcta == 'si' ? 'is-valid' : 'is-invalid'}}"
						value="{{ $res->respuesta }}">
					</div>
				</div>
				@endforeach
				<div class="row justify-content-center">
					<div class="form-group">
						<button class="btn btn-success" type="submit">Editar</button>
						<button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close">Cerrar</button>
					</div>
				</div>	
			</form>						
		</div>
	  </div>
	</div>
</div>
@endforeach
{{-- FIN MODAL  RESPUESTAS--}}

@endsection


@section('scripts')

@endsection