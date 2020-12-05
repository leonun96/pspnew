
@extends('layouts.profesor')

@section('titulo','Crear diagnostico')
@section('direccion', 'Crear diagnostico')

@section('estilos')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.css" integrity="sha512-CWdvnJD7uGtuypLLe5rLU3eUAkbzBR3Bm1SFPEaRfvXXI2v2H5Y0057EMTzNuGGRIznt8+128QIDQ8RqmHbAdg==" crossorigin="anonymous" />

@endsection

@section('contenido')

<div class="container">
    <div class="row justify-content-center">
        <div class="card mx-auto shadow">
            <div class="card-title mt-4 ml-4 mr-4">
                <h1 class="">Diagnostico para {{ $alumno->nombres }} {{$alumno->apellidos }}</h1>
            </div>
            <div class="card-body">
            <form action="{{ route('profesor.diagnostico') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="rut">RUT</label>
                        <input type="text" name="id" value="{{$alumno->id }}" hidden >
                        <input type="text" class="form-control" name="rut" id="rut" value="{{$alumno->rut }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="diagnostico">Diagnostico</label>
                        <input type="hidden" name="diagnostico" id="diagnostico" value="">
                        <trix-editor input="diagnostico"></trix-editor>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-success" value="Agregar diagnostico">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.js" integrity="sha512-/1nVu72YEESEbcmhE/EvjH/RxTg62EKvYWLG3NdeZibTCuEtW5M4z3aypcvsoZw03FAopi94y04GhuqRU9p+CQ==" crossorigin="anonymous"></script>
@endsection