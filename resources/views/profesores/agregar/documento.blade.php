@extends('layouts.profesor')
@section('titulo','Agregar documento')
@section('direccion', 'Nuevo documento')

@section('contenido')


@if(session()->has('flash'))
	<br>
	<div class="container">
		<div class="alert alert-success">
			{{ session('flash') }}
		</div>
	</div>
@endif

<div class="cotainer">
    <div class="row ml-5">
        <div class="col col-12">
            <h1>Subir documentos</h1>
        </div>
        <div class="col col-12">
        <form action="{{Route('profesor.uploadDoc')}}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="input-group">
                <div class="custom-file">
                  <input type="file"  name="archivo" class="custom-file-input" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04">
                  <label class="custom-file-label" for="inputGroupFile04">Choose file</label>
                </div>
                <div class="input-group-append">
                  <button class="btn btn-outline-primary" type="submit" id="inputGroupFileAddon04">Subir</button>
                </div>
              </div>


        </form>
        </div>
    </div>
</div>
@endsection
@section('scripts')

@endsection