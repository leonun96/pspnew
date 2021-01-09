@extends('layouts.alumno')
@section('titulo', 'Inicio')
@section('direccion', 'Documentos')

@section('contenido')

<h1 class="text-center uppercase text-bold">Listado de documentos asignados</h1>

<div class="row col-12">
	<table class="table purple">
		<thead class="thead-dark">
			<tr>
				<th scope="col">Nombre</th>
				<th scope="col">Descargar</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($documentos as $doc)
			<tr>
				<td>{{ $doc->documentos->ruta }}</td>
				<td><a href="{{ route('alumno.descargar_doc', $doc->documentos->id) }}" class="btn btn-outline-success">Descargar</a></td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>
		
@endsection