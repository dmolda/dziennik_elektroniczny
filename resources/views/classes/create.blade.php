@extends('layout')

@section('page_info')
    {{ __('Dodawanie nowej klasy') }}
@endsection

@section('content')


    {!! Form::open(['route' => 'classes.store']) !!}

    @if ($errors->any())
        <ul class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <div class="btn btn-danger">{{ $error }}</div>
            @endforeach
        </ul>
    @endif


    <div class="form-group">
        {!! Form::label('name', "Nazwa klasy:") !!}
        {!! Form::text('name', null, ['class'=>'form-control']) !!}

        {!! Form::label('description', "Opis:") !!}
        {!! Form::text('description', null, ['class'=>'form-control']) !!}

        <br>

        {!! Form::submit('Zapisz',['class'=>'btn btn-outline-primary']) !!}
        {!! link_to(URL::previous(),'Powrót',['class'=> 'btn btn-outline-secondary']) !!}
    </div>


    {!! Form::close() !!}
@endsection
