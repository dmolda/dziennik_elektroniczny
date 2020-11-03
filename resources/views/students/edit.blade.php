@extends('layout')

@section('page_info')
    {{ __('Edytujesz profil ') }}
@endsection

@section('content')

    {!! Form::model($student, ['route' => ['students.update', $student], 'method' => 'PUT']) !!}


    @if ($errors->any())
        <ul class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <div class="btn btn-danger">{{ $error }}</div>
            @endforeach
        </ul>
    @endif


    <div class="form-group">
        {!! Form::label('name', "Pierwsze imie:") !!}
        {!! Form::text('name', $student->name, ['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('second_name', "Drugie imię:") !!}
        {!! Form::text('second_name', $student->second_name, ['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('last_name', "Nazwisko:") !!}
        {!! Form::text('last_name', $student->last_name, ['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('date_of_birth', "Data urodzenia:") !!}
        {!! Form::date('date_of_birth', $student->date_of_birth, ['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('sex', "Płeć:") !!}
        {!! Form::select('sex', array('kobieta' => 'kobieta', 'mężczyzna' => 'mężczyzna') , $student->sex, ['class'=>'form-control']) !!}
    </div>


    <div class="form-group">
        {!! Form::submit('Zapisz',['class'=>'btn btn-outline-primary']) !!}
        <a class="btn btn-outline-secondary" href="{{ route('users.index') }}" role="button">Powrót</a>
    </div>


    {!! Form::close() !!}
@endsection
