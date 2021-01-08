<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>PSPSYSTEM Alumnos | Log in</title>
	<!-- Google Font: Source Sans Pro -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="AdminLte/plugins/fontawesome-free/css/all.min.css">
	<!-- icheck bootstrap -->
	<link rel="stylesheet" href="AdminLte/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="AdminLte/css/adminlte.min.css">
</head>
<body class="hold-transition login-page bg-teal">
<div class="login-box">
	<div class="login-logo bg-olive">
		<a href=""><b>PSP</b>SYSTEM</a>
	</div>
	<!-- /.login-logo -->
	<div class="card">
		<div class="card-body login-card-body">
			<p class="login-box-msg">Inicia sesión para comenzar</p>
			<form action="{{ route('alumno.loginAlumno') }}" method="POST">
				@csrf
				<div class="input-group mb-3 ">
					<input type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : ''}}" name="email" placeholder="Email"value="{{ old('email') }}">
					<div class="input-group-append">
						<div class="input-group-text">
							<span class="fas fa-envelope"></span>
						</div>
					</div>
				</div>
			{!! $errors->first('email') !!}
				<div class="input-group mb-3">
					<input type="password" class="form-control  {{ $errors->has('password') ? 'is-invalid' : ''}}" name="password" placeholder="Contraseña">
					<div class="input-group-append">
						<div class="input-group-text">
							<span class="fas fa-lock"></span>
						</div>
					</div>
				</div>
			{!! $errors->first('password') !!}
				<div class="row">
					{{-- <div class="col-8">
						<div class="icheck-primary">
							<input type="checkbox" id="remember">
							<label for="remember">
								Recuérdame
							</label>
						</div>
					</div> --}}
					<!-- /.col -->
					<div class="col-12 text-center">
						<button type="submit" class="btn btn-success btn-block">Entrar</button>
					</div>
					<!-- /.col -->
				</div>
			</form>
			<p class="mb-1 mt-2">
				<a href="#">No recuerdas tu contraseña?</a>
			</p>
			{{-- <p class="mb-0">
				<a href="#" class="text-center">Registrar una nueva membresía</a>
			</p> --}}
		</div>
		<!-- /.login-card-body -->
	</div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{ asset('AdminLte/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('AdminLte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('AdminLte/js/adminlte.min.js') }}"></script>

</body>
</html>
