@extends('layouts.alumno')

@section('titulo','Editar Perfil')
@section('direccion', 'Editar perfil')

@section('contenido')
<style type="text/css">
	input.error {
		border-color: #F44336!important;
		outline: 0!important;
		-webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075), 0 0 8px rgba(244, 67, 54, .6)!important;
		box-shadow: inset 0 1px 1px rgba(0,0,0,.075), 0 0 8px rgba(244, 67, 54, .6)!important;
	}
</style>
<div class="card card-purple col-12 ">

<div class="card-header">
	<h3 class="card-title">Editar Contraseña</h3>
</div>

@if(session()->has('flash'))
<br>
<div class="container">
	<div class="alert alert-success">
	{{ session('flash') }}
	</div>
</div>
@endif
<form action="{{ route('alumno.cambiar.pass') }}" method="POST">
	@csrf
	<div class="card-body">
		<div class="form-group">
			<label for="email">Contraseña actual</label>
			<input type="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : ''}}" name="password_old">
		</div>
		<div class="form-group">
			<label for="email">Contraseña nueva</label>
			<input type="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : ''}}" name="password">
		</div>
		<div class="form-group">
			<label for="email">Confirme contraseña nueva</label>
			<input type="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : ''}}" name="password_confirmation">
		</div>
	</div>
							
	<div class="card card-footer">
		<button type="submit" class="btn btn-success">Editar Pass</button>
	</div>
</form>

</div>
@endsection
@section('scripts')
@endsection


