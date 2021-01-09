@extends('layouts.profesor')

@section('titulo','Ver Actividades realizadas')
@section('direccion', 'Ver Actividades realizadas')

@section('contenido')
<div class="card  card-purple col-12">

	<div class="card-header">
		<h3 class="card-title">Listado de actividades realizadas</h3>
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
				<th>#</th>
				<th>Actividad</th>
				<th>Alumno</th>
				<th>Ver</th>
			</tr>
			</thead>
			<tbody>
				@foreach ($finalizadas as $key =>  $fin)
				<tr>
					<td>{{ $key+1 }}</td>
					<td>{{ $fin->actividades->nombre }}</td>
					<td>{{ $fin->alumnos->nombres }}</td>
					<td><button type="button" class="btn btn-block btn-outline-success" data-toggle="modal" data-target="#modal-{{ $fin->id}}"><i class="fas fa-eye"></i></button></td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>



@foreach ($finalizadas as $fin)
<!-- Modal -->
<div class="modal fade" id="modal-{{$fin->id}}" tabindex="-1" role="dialog" aria-labelledby="titulo" aria-hidden="true">
	<div class="modal-dialog" role="document">
	  <div class="modal-content">
		<div class="modal-header">
		  <h5 class="modal-title" id="titulo">Resultados</h5>
		  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		  </button>
		</div>
		<div class="modal-body">
			<div class="container">
				<div class="row">
					<div class="col col-12 align-self-center text-center ">
						{{-- @dump($fin) --}}
						<div class="form-group">
							@foreach ($fin->resultados->detalle as $detalle)
							<p class="text-bold uppercase h1">{{$detalle->preguntas->pregunta}}</p>
							<div class="custom-control custom-radio custom-control-inline">
								<p class="ml-2">Respuesta:</p>
								<p class="ml-2">{{$detalle->respuestas->respuesta}}</p>
							</div>
							<div class="custom-control custom-radio custom-control-inline">
								<p class="ml-2">Correcta:</p>
								<p class="ml-2">{{$detalle->respuestas->correcta}}</p>
							</div>
							@endforeach
						</div>
						<br><br>
						
						<form action="{{ route('profesor.agregarResultado',$detalle->resultado_evaluacions_id) }}" method="POST">
							@csrf
							@method('PUT')
							<div class="form-group">
								<div class="row">
									<div class="col">
										<label for="puntaje">Puntaje</label>
										<input type="text" class="form-control" name="puntaje" value="{{ !is_null($fin->resultados) ? $fin->resultados->puntaje : '' }}">
									</div>
									<div class="col">
										<label for="nota">Nota</label>
										<input type="text" class="form-control" name="nota" value="{{ !is_null($fin->resultados) ? $fin->resultados->nota : '' }}">
									</div>
								</div>
								<div class="modal-footer col-12">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
									<button type="submit" class="btn btn-primary">Guardar nota</button>
								  </div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		
	  </div>
	</div>
  </div>
  @endforeach

@endsection

@section('scripts')
	
@endsection

			 