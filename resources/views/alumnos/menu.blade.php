@extends('layouts.alumno')
@section('titulo', 'Inicio')

@section('contenido')

<div class="row col-12">
	{{--  --}}
	<div class="row">
		<div class="col-6">
			<div class="small-box bg-info">
				<div class="inner">
					<h3>{{ $actividade}}</h3>
					<p>Total de actividades</p>
				</div>
				<div class="icon">
					<i class="ion ion-bag"></i>
				</div>
				<a href="{{ route('alumno.verActividades') }}" class="small-box-footer">Mas informacion <i class="fas fa-arrow-circle-right"></i></a>
			</div>
		</div>
		<div class=" col-6">
			<div class="small-box bg-success">
				<div class="inner">
					<h3>{{ $documento }}</h3>
					<p>Total de documentos</p>
				</div>
				<div class="icon">
					<i class="ion ion-stats-bars"></i>
				</div>
				<a href="{{ route('alumno.verDocumentos') }}" class="small-box-footer">Mas informacion <i class="fas fa-arrow-circle-right"></i></a>
			</div>
		</div>
	</div>
	<div class="col-12">
		<button type="button" class="btn btn-warning  btn-block" data-toggle="modal" data-target="#exampleModal">
			<i class="fas fa-envelope-open-text"></i> Enviar Correo al profesor
		</button>
	</div>
</div>




<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
	  <div class="modal-content">
		<div class="modal-header">
		  <h5 class="modal-title" id="exampleModalLabel">Enviar Correo</h5>
		  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		</div>
		<div class="modal-body">
			<div class="mb-3">
				<label for="exampleFormControlInput1" class="form-label">Asunto</label>
				<input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
			  </div>
			  <div class="mb-3">
				<label for="exampleFormControlTextarea1" class="form-label">Mensaje</label>
				<textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
			  </div>
		</div>
		<div class="modal-footer">
		  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
		  <button type="button" class="btn btn-primary">Enviar</button>
		</div>
	  </div>
	</div>
  </div>
		
@endsection