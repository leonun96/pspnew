<!DOCTYPE html>
<html>
<head>
	<title>LOGIN ALUMNO</title>
	<link rel="stylesheet" type="text/css" href="{{asset('login1/css/style.css')}}">
	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
	<img class="wave" src="{{asset('login1/img/wave.png')}}">
	<div class="container">
		<div class="img">
			<img src="{{asset('login1/img/bg.svg')}}">
		</div>
		<div class="login-content">
			<form action="{{ route('alumno.loginAlumno') }}" method="post">
				@csrf
				<img src="{{asset('login1/img/avatar.svg')}}">
				<h2 class="title">Bienvenido</h2>
				<div class="input-div one">
				   <div class="i">
						<i class="fas fa-user"></i>
				   </div>
				   <div class="div">
						<h5>Usuario</h5>
						<input type="text" name="email" class="input">
				   </div>
				</div>
				<div class="input-div pass">
				   <div class="i"> 
						<i class="fas fa-lock"></i>
				   </div>
				   <div class="div">
						<h5>Contraseña</h5>
						<input type="password" name="password" class="input">
				   </div>
				</div>
				<a href="#">Olvidaste tu contraseña?</a>
				<input type="submit" class="btn" value="Login">
			</form>
		</div>
	</div>
	<script type="text/javascript" src="{{asset('login1/js/main.js')}}"></script>
</body>
</html>
