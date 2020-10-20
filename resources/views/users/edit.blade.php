@extends('layout')

@section('page_info')
    {{ __('Edycja użytkownika') }}
@endsection

@section('content')

{!! Form::model($user, ['route' => ['users.update', $user], 'method' => 'PUT']) !!}


    @if ($errors->any())
        <ul class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <div class="btn btn-danger">{{ $error }}</div>
            @endforeach
        </ul>
    @endif


    <div class="form-group">
        {!! Form::label('name', "Nazwa użytkownika:") !!}
        {!! Form::text('name', $user->name, ['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('email', "Adres Email:") !!}
        {!! Form::email('email', $user->email, ['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('password', "Hasło:") !!}
        {!! Form::password('password', ['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::submit('Zapisz',['class'=>'btn btn-outline-primary']) !!}
        <a class="btn btn-outline-secondary" href="{{ route('users.index') }}" role="button">Powrót</a>
    </div>


    {!! Form::close() !!}
@endsection
