@extends('layouts.alumno')
@section('titulo', 'Inicio')

@section('contenido')
<div class="container">
    <div class="row">
        <div class="col col-12 align-self-center text-center ">
        <form action="{{Route('alumno.finalizada')}}" method="POST">
            @csrf
            <div class="form-group">
                @foreach ($actividad->preguntas as $pregunta)
                    <p class="text-bold uppercase h1">{{$pregunta->pregunta}}</p>
                    @foreach ($pregunta->respuestas as $respuesta)
                    <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio"  name="pregunta[{{$pregunta->id}}]" class="form-group" value="{{$respuesta->id}}">
                        <p class="ml-2">{{$respuesta->respuesta}}</p>
                    </div>
                    @endforeach
                @endforeach
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Finalizar</button>
            </div>
            </form>
        </div>
    </div>
</div>		
@endsection