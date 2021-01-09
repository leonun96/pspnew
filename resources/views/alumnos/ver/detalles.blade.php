@extends('layouts.alumno')
@section('titulo', 'Inicio')

@section('contenido')


<h1 class="text-center uppercase text-bold">Detalle de evaluacion</h1>

<div class="container">
	<div class="row">
		<div class="col col-12 align-self-center text-center ">
            <div class="form-group">
                @foreach ($detalle->detalle as $det)
                    <p class="text-bold uppercase h1">{{$det->preguntas->pregunta}}</p>
                    <p class="">Tu respuesta:  {{$det->respuestas->respuesta}}</p>
                    <p class=" text-bold h5 text-right uppercase {{ $det->correcta == 'si' ? 'text-green' : 'text-red'  }}">
                        {{$det->correcta == 'si' ? 'Correcta' : 'Incorrecta'}}
                    </p>
                @endforeach
            </div>
            <a href="{{Route('alumno.actividades.resultados')}}" class="btn btn-outline-secondary btn-block">Volver</a>
        </div>
        </div>
	</div>
</div>
@endsection