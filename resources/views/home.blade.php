<!DOCTYPE html>
<html>
<head>
	<title>INICIO - PSPSYSTEM</title>
	<link rel="stylesheet" type="text/css" href="{{ asset('bootstrap-4.5.2-dist/css/bootstrap.min.css') }}">
	<!-- Google Font: Source Sans Pro -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
	<!-- Font Awesome Icons -->
	{{-- <link rel="stylesheet" href="{{ asset('AdminLte/plugins/fontawesome-free/css/all.min.css') }}"> --}}
	<!-- Theme style -->
	{{-- <link rel="stylesheet" href="{{ asset('AdminLte/css/adminlte.min.css') }}"> --}}
	<style type="text/css">
		.izquierda, .derecha {
			height: 50vh;
			width: 100%;
		}
		@media screen and (min-width:768px){
			.izquierda, .derecha {
				height: 100vh;
			}
		}
		.izquierda {
			background: green;
		}
		.derecha {
			background: purple;
		}
		.cont{
			position: absolute;
			left: 0;
			right: 0;
			margin: auto;
			top: 50%;
			transform: translateY(-50%);
		}
	</style>
</head>
<body>

	<div class="row no-gutters">

		{{-- LADO IZQUIERDO --}}
		<div class="col-md-6 no-gutters">

			<div class="izquierda d-flex justify-content-center align-items-center">
				<div class="container cont">
					<div class="row">
						<div class="col-md-5 mx-auto mb-5">
							<div class="card h-100 py-5 bg-primary">
								<div class="card-body">
									<!-- Acá contenido -->
									<h5 class="card-title">Si eres profesor</h5>
									<a href="{{ route('profesor.acceso') }}" class="btn btn-dark stretched-link">Click Aquí!</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

		</div>



		{{-- LADO DERECHO --}}
		<div class="col-md-6 no-gutters">

			<div class="derecha  d-flex justify-content-center align-items-center">
				<div class="container cont">
					<div class="row">
						<div class="col-md-5 mx-auto mb-5">
							<div class="card h-100 py-5 bg-primary">
								<div class="card-body">
									<!-- Acá contenido -->
									<h5 class="card-title">Si eres alumno</h5>
									<a href="{{ route('alumno.acceso') }}" class="btn btn-dark stretched-link">Click Aquí!</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>

</body>

</html>









