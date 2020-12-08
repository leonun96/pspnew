@extends('layouts.profesor')
@section('titulo','Crear Actividad')
@section('direccion', 'Crear nueva actividad')
@section('contenido')
		

<div class="card card-purple col-12">
	<div class="card-header">
		<h3 class="card-title">Crear nueva actividad</h3>
	</div>
	<form action="{{ route('profesor.nuevaActividad') }}" method="POST">
		@csrf
		<div class="card-body">
			<div class="form-group">
				<label for="nombre">Nombre de la actividad</label>
				<input type="text" class="form-control" name="nombre" >
			</div>
			<div class="form-group">
				<label for="categorias">Categoria</label>
				<select name="categorias" class="form-control" id="categorias">
					<option value="">Selecione una categoria</option>
					@foreach ($categorias as $categoria)
					<option value="{{ $categoria->id }}">{{ $categoria->COD }} - {{ $categoria->nombre }} </option>
					@endforeach
				</select>
			</div>
			<div class="form-group">
				<label for="subcategorias">Subcategoria</label>
				<select name="subcategorias" class="form-control" id="subcategorias">
					<option value=""></option>
				</select>
			</div>
			<div class="form-group">
				<label for="niveles">Nivel</label>
				<select name="niveles" class="form-control" id="niveles">
					@foreach ($niveles as $nivel)
					<option value="{{ $nivel->id }}">{{ $nivel->COD }} - {{ $nivel->nivel }} </option>
					@endforeach
				</select>
			</div>
		</div>
		<div class="card card-footer">
			<button type="submit" class="btn btn-success">Siguiente paso</button>
		</div>
	</form>
</div>
@endsection

@section('scripts')
	<script>

		$(function(){
			$('#categorias').on('change',obtenerSubcate);
		});

		function obtenerSubcate(){
			var id = $(this).val();
			// AJAX
			$.get('/api/subcategoria/'+id,function (data){
				var html_select = '<option value="">Seleccion una subcategoria</option>';

				for(var i=0; i<data.length; i++)
				html_select += '<option value="'+data[i].id+'">'+data[i].nombre+'</option>';
				
				$('#subcategorias').html(html_select);
			});

		}

	</script>
@endsection