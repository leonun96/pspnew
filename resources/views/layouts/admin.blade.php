<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>PSPSYSTEM | @yield('titulo')</title>

	@yield('estilos')

	<!-- Google Font: Source Sans Pro -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
	<!-- Font Awesome Icons -->
	<link rel="stylesheet" href="{{ asset('AdminLte/plugins/fontawesome-free/css/all.min.css') }}">
	<!-- Theme style -->
	<link rel="stylesheet" href="{{ asset('AdminLte/css/adminlte.min.css') }}">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
	<!-- Navbar -->
	<nav class="main-header navbar navbar-expand navbar-white navbar-light">
		<!-- Left navbar links -->
		<ul class="navbar-nav">
			<li class="nav-item">
				<a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
			</li>
		</ul>
	</nav>
	<!-- /.navbar -->
	<!-- Main Sidebar Container -->
	<aside class="main-sidebar sidebar-dark-purple elevation-4">
		<!-- Brand Logo -->
		<a href="{{ route('profesor.menu') }}" class="brand-link">
			<img src="{{ asset('AdminLte/img/AdminLTELogo.png') }}" alt="" class="brand-image img-circle elevation-3" style="opacity: .8">
			<span class="brand-text font-weight-light">PSP SYSTEM</span>
		</a>
		<!-- Sidebar -->
		<div class="sidebar">
			<!-- ESTO ES EL USUARIO CON SU FOTITO -->
			<div class="user-panel mt-3 pb-3 mb-3 d-flex">
				<div class="image">
					<img src="{{ asset('AdminLte/img/user5-128x128.jpg') }}" class="img-circle elevation-2" alt="User Image">
				</div>
				<div class="info">
					<a href="{{ route('profesor.menu') }}" class="d-block">{{ Auth::user()->name }}</a>
				</div>
			</div>
			<!-- Sidebar Menu -->
			<nav class="mt-2">
				<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
					<!-- ESTO ES EL SIDEBARD DEL LADO IZQUIERO DE LA PANTALLA !! -->
					<li class="nav-item has-treeview menu-{{ Request::is('admin/profesores*') ? 'open' : 'close' }}">
						<a href="#" class="nav-link {{ Request::is('admin/profesores*') ? 'active' : '' }}">
							<i class="nav-icon fas fa-user"></i><p>Gestion de profesores<i class="fas fa-angle-left right"></i></p>
						</a>
						<ul class="nav nav-treeview">
							<li class="nav-item">
								<a href="{{ route('admin.agregarProfesor') }}" class="nav-link {{ Request::is('admin/profesores/agregar-profesor') ? 'active' : '' }}">
									<i class="far fa-circle nav-icon"></i><p>Agregar profesor</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="{{ route('admin.profesores') }}" class="nav-link {{ Request::is('admin/profesores') ? 'active' : '' }}">
									<i class="far fa-circle nav-icon"></i>
									<p>Visualizar profesores</p>
								</a>
							</li>
						</ul>
					</li>
					<li class="nav-item has-treeview menu-{{ Request::is('admin/alumnos*') ? 'open' : 'close' }}">
						<a href="#" class="nav-link {{ Request::is('admin/alumnos*') ? 'active' : '' }}">
							<i class="nav-icon fas fa-user"></i><p>Gestion de alumnos<i class="fas fa-angle-left right"></i></p>
						</a>
						<ul class="nav nav-treeview">
							<li class="nav-item">
								<a href="{{ route('admin.agregarAlumno') }}" class="nav-link {{ Request::is('admin/alumnos/agregar-alumno') ? 'active' : '' }}">
									<i class="far fa-circle nav-icon"></i><p>Agregar alumno</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="{{ route('admin.alumnos') }}" class="nav-link {{ Request::is('admin/alumnos') ? 'active' : '' }}">
									<i class="far fa-circle nav-icon"></i>
									<p>Visualizar alumnos</p>
								</a>
							</li>
						</ul>
					</li>
					<li class="nav-item has-treeview menu-close">
						<form method="post" id="close_session" action="{{ route('logout') }}">
							@csrf
							<a href="#" onclick="return logoutJs()">
								<i class="nav-icon fas fa-sign-out-alt"></i>Cerrar Sesion
							</a>
						</form>
					</li>	
				</ul>
			</nav>
			<!-- /.sidebar-menu -->
		</div>
		<!-- /.sidebar -->
	</aside>
	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-6"><!-- <h1 class="m-0 text-dark">Agregar Nuevo Alumno</h1> --></div><!-- /.col -->
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="{{ route('profesor.menu') }}">Inicio</a></li>
							<li class="breadcrumb-item active">@yield('direccion')</li>
						</ol>
					</div><!-- /.col -->
				</div><!-- /.row -->
			</div><!-- /.container-fluid -->
		</div>
		<!-- /.content-header -->
		<!-- BODY DONDE IRA CONTENIDO -->
		@include('flash::message')
		@if ($errors->any())
		<div class="alert alert-danger m-2">
			<ul>
				@foreach ($errors->all() as $error)
				<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
		@endif
		<div class="content">
			<div class="container-fluid">
				<div class="row">
					@yield('contenido')
				</div><!--fin row-->
			</div>
		</div>
		<!-- /.content -->
	</div>
<!-- /.content-wrapper -->
<!-- Main Footer -->
<footer class="main-footer">
	<!-- Default to the left -->
	<strong>Copyright &copy; 2017-2020 <a href="https://atlasdev.cl">Atlasdev.cl</a>.</strong> All rights reserved.
</footer>
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ asset('AdminLte/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('AdminLte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('AdminLte/js/adminlte.min.js')}}"></script>

@yield('scripts')
<script>
	$('div.alert').not('.alert-important').delay(3000).fadeOut(350);
	function logoutJs () {
		$("#close_session").submit();
	}
</script>

</body>
</html>



			