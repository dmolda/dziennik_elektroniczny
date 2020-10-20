@extends('layout')

@section('page_info')
    {{ __('Dodawanie nowego ucznia') }}
@endsection

@section('content')


    {!! Form::open(['route' => 'students.store']) !!}

    @if ($errors->any())
        <ul class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <div class="btn btn-danger">{{ $error }}</div>
            @endforeach
        </ul>
    @endif


    <div class="form-group">
        {!! Form::label('name', "Nazwa klasy:") !!}
        <input type="hidden" name="users_id" value="{!! $_GET['user_id'] !!}">
        <select class="form-control" id="classes_id" name="classes_id">
            <?php
            foreach ($class_list as $class){
                echo "<option value='$class->id'>Klasa: " . $class->name . " Imie i nazwisko wychowawcy #dodac " ."</option>";
            }
            ?>


        </select>


        <br>

        {!! Form::submit('Zapisz',['class'=>'btn btn-outline-primary']) !!}
        {!! link_to(URL::previous(),'Powrót',['class'=> 'btn btn-outline-secondary']) !!}
    </div>


    {!! Form::close() !!}
@endsection
