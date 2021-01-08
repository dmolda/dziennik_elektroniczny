@extends('layout')

@section('page_info')
    {{ __('Edytujesz profil ') }}
@endsection

@section('content')

    {!! Form::model($parent, ['route' => ['parents.update', $parent], 'method' => 'PUT']) !!}


    @if ($errors->any())
        <ul class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <div class="btn btn-danger">{{ $error }}</div>
            @endforeach
        </ul>
    @endif


    <div class="form-group">
        {!! Form::label('name', "Pierwsze imie:") !!}
        {!! Form::text('name', $parent->name, ['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('second_name', "Drugie imię:") !!}
        {!! Form::text('second_name', $parent->second_name, ['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('last_name', "Nazwisko:") !!}
        {!! Form::text('last_name', $parent->last_name, ['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('date_of_birth', "Data urodzenia:") !!}
        {!! Form::date('date_of_birth', $parent->date_of_birth, ['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('sex', "Płeć:") !!}
        {!! Form::select('sex', array('kobieta' => 'kobieta', 'mężczyzna' => 'mężczyzna') , $parent->sex, ['class'=>'form-control']) !!}
    </div>


    <div class="form-group">
        {!! Form::submit('Zapisz',['class'=>'btn btn-outline-primary']) !!}
        <a class="btn btn-outline-secondary" href="{{ route('parents.show', $parent->id) }}" role="button">Powrót</a>
    </div>


    {!! Form::close() !!}
@endsection
