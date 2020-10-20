@extends('layout')

@section('page_info')
    {{ __('Dodawanie nowego użytkownika') }}
@endsection

@section('content')


    {!! Form::open(['route' => 'users.store']) !!}

    @if ($errors->any())
        <ul class="alert alert-danger">
        @foreach ($errors->all() as $error)
            <div class="btn btn-danger">{{ $error }}</div>
        @endforeach
        </ul>
    @endif


    <div class="form-group">
        {!! Form::label('name', "Nazwa użytkownika:") !!}
        {!! Form::text('name', null, ['class'=>'form-control']) !!}
{{--    </div>--}}

{{--    <div class="form-group">--}}
        {!! Form::label('email', "Adres Email:") !!}
        {!! Form::email('email', null, ['class'=>'form-control']) !!}
{{--    </div>--}}

{{--    <div class="form-group">--}}
        {!! Form::label('password', "Hasło:") !!}
        {!! Form::password('password', ['class'=>'form-control']) !!}
{{--    </div>--}}


{{--    <div class="form-group">--}}
        {!! Form::submit('Zapisz',['class'=>'btn btn-outline-primary']) !!}
        {!! link_to(URL::previous(),'Powrót',['class'=> 'btn btn-outline-secondary']) !!}
    </div>


    {!! Form::close() !!}
@endsection
