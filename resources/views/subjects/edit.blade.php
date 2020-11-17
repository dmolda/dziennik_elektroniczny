@extends('layout')

@section('page_info')
    {{ __('Edycja przedmiotu') }}
@endsection

@section('content')

    {!! Form::model($subject, ['route' => ['subjects.update', $subject], 'method' => 'PUT']) !!}


    @if ($errors->any())
        <ul class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <div class="btn btn-danger">{{ $error }}</div>
            @endforeach
        </ul>
    @endif


    <div class="form-group">
        {!! Form::label('name', "Nazwa przedmiotu:") !!}
        {!! Form::text('name', $subject->name, ['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('description', "Opis:") !!}
        {!! Form::text('description', $subject->description, ['class'=>'form-control']) !!}
    </div>


    <div class="form-group">
        {!! Form::submit('Zapisz',['class'=>'btn btn-outline-primary']) !!}
        <a class="btn btn-outline-secondary" href="{{ route('subjects.index') }}" role="button">Powrót</a>
    </div>


    {!! Form::close() !!}
@endsection
