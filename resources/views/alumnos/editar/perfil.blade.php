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
	<h3 class="card-title">Editar Perfil</h3>
</div>

@if(session()->has('flash'))
<br>
<div class="container">
	<div class="alert alert-success">
	{{ session('flash') }}
	</div>
</div>
@endif
@foreach ($perfil as $dato)
@endforeach
<form action="{{ route('alumno.editarPerfil', $perfil->id) }}" method="POST">
	{{ csrf_field() }}
	
		<div class="card-body">
			<div class="form-group">
				<label for="rut">RUT</label>
				<input type="text" class="form-control {{ $errors->has('rut') ? 'is-invalid' : ''}}"
				name="rut" id="rut" oninput="checkRut(this)" placeholder="Ingrese el RUT del alumno"
				value="{{ $perfil->rut }}">
			</div>
			<div class="form-group">
				<label for="nombres">Nombres</label>
				<input type="text" class="form-control {{ $errors->has('nombres') ? 'is-invalid' : ''}}" 
				name="nombres" placeholder="Ingrese el nombre del alumno"
				value="{{ $perfil->nombres }}">
			</div>
			<div class="form-group">
				<label for="apellidos">Apellidos</label>
				<input type="text" class="form-control" name="apellidos"
				 placeholder="Ingrese apellidos del alumno" value="{{ $perfil->apellidos }}">
			</div>
			<div class="form-group">
				<label for="fnac">Fecha nacimiento</label>
				<input type="date" class="form-control {{ $errors->has('fnac') ? 'is-invalid' : ''}}"
				 name="fnac"  value="{{ $perfil->fnac }}">
			</div>
			<div class="form-group">
				<label for="telenfono">Telefono</label>
				<input type="text" class="form-control" name="telefono"
				value="{{ $perfil->telefono }}" placeholder="Ingrese telefono del alumno" >
			</div>
			<div class="form-group">
				<label for="email">Email</label>
				<input type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : ''}}" 
				name="email"  placeholder="Ingrese email del alumno" value="{{ $perfil->email }}">
			</div>
			{{-- <div class="form-group">
				<label for="email">Contraseña</label>
				<input type="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : ''}}" 
				name="password">
			</div> --}}
		</div>
								
		<div class="card card-footer">
			<button type="submit" class="btn btn-success">Editar Perfil</button>
		</div>
</form>

</div>
@endsection
@section('scripts')
<script type="text/javascript">
		function checkRut(rut) {
				// Despejar Puntos
				var valor = rut.value.replace('.','');
				// Despejar Guión
				valor = valor.replace('-','');
				
				// Aislar Cuerpo y Dígito Verificador
				cuerpo = valor.slice(0,-1);
				dv = valor.slice(-1).toUpperCase();
				
				// Formatear RUN
				rut.value = cuerpo + '-'+ dv
				
				// Si no cumple con el mínimo ej. (n.nnn.nnn)
				if(cuerpo.length < 7) { rut.setCustomValidity("RUT Incompleto"); rut.classList.add("error"); return false;}
				
				// Calcular Dígito Verificador
				suma = 0;
				multiplo = 2;
				
				// Para cada dígito del Cuerpo
				for(i=1;i<=cuerpo.length;i++) {
						// Obtener su Producto con el Múltiplo Correspondiente
						index = multiplo * valor.charAt(cuerpo.length - i);
						// Sumar al Contador General
						suma = suma + index;
						// Consolidar Múltiplo dentro del rango [2,7]
						if(multiplo < 7) { multiplo = multiplo + 1; } else { multiplo = 2; }
				}
				
				// Calcular Dígito Verificador en base al Módulo 11
				dvEsperado = 11 - (suma % 11);
				
				// Casos Especiales (0 y K)
				dv = (dv == 'K')?10:dv;
				dv = (dv == 0)?11:dv;
				
				// Validar que el Cuerpo coincide con su Dígito Verificador
				if(dvEsperado != dv) { rut.setCustomValidity("RUT Inválido"); rut.classList.add("error"); return false; }
				
				// Si todo sale bien, eliminar errores (decretar que es válido)
				rut.setCustomValidity('');rut.classList.remove("error");
		}
</script>
@endsection


