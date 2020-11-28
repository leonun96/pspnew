
@extends('layouts.profesor')

@section('titulo','Menu Profesor')
@section('direccion', 'Menu principal')

@section('contenido')
<div class="row col-12">
		<div class="col-lg-3 col-6">
			<div class="small-box bg-info">
				<div class="inner">
					<h3>{{ $alumnos}}</h3>
					<p>Total de alumnos</p>
				</div>
				<div class="icon">
					<i class="ion ion-bag"></i>
				</div>
				<a href="{{ route('profesor.verAlumnos') }}" class="small-box-footer">Mas informacion <i class="fas fa-arrow-circle-right"></i></a>
			</div>
		</div>
		<div class="col-lg-3 col-6">
			<div class="small-box bg-success">
				<div class="inner">
					<h3>{{ $act }}</h3>
					<p>Total de actividades</p>
				</div>
				<div class="icon">
					<i class="ion ion-stats-bars"></i>
				</div>
				<a href="{{ route('profesor.verActividades') }}" class="small-box-footer">Mas informacion <i class="fas fa-arrow-circle-right"></i></a>
			</div>
		</div>
	</div>
		
@endsection