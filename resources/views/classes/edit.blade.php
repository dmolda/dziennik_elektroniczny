@extends('layout')

@section('page_info')
    {{ __('Edycja klasy') }}
@endsection

@section('content')

    {!! Form::model($class, ['route' => ['classes.update', $class], 'method' => 'PUT']) !!}


    @if ($errors->any())
        <ul class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <div class="btn btn-danger">{{ $error }}</div>
            @endforeach
        </ul>
    @endif


    <div class="form-group">
        {!! Form::label('name', "Nazwa klasy:") !!}
        {!! Form::text('name', $class->name, ['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('description', "Opis:") !!}
        {!! Form::text('description', $class->description, ['class'=>'form-control']) !!}
    </div>


    <div class="form-group">
        {!! Form::submit('Zapisz',['class'=>'btn btn-outline-primary']) !!}
        <a class="btn btn-outline-secondary" href="{{ route('classes.index') }}" role="button">Powrót</a>
    </div>


    {!! Form::close() !!}
@endsection
