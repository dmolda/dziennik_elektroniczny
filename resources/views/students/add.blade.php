@extends('layout')

@section('page_info')
    {{ __('Dodawanie nowego ucznia') }}
@endsection

@section('content')


    {!! Form::open(['route' => 'students.storeadd']) !!}

    @if ($errors->any())
        <ul class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <div class="btn btn-danger">{{ $error }}</div>
            @endforeach
        </ul>
    @endif


    <div class="form-group">
        {!! Form::label('name', "Nazwa ucznia:") !!}
        <select class="form-control" id="students_id" name="students_id">
            <option value="" disabled selected>Wybierz ucznia</option>
            <?php
            foreach ($student_list as $student){
                echo "<option value='$student->id'>". $student->name . " " . $student->second_name . " " . $student->last_name . "</option>";

            }

            ?>




        </select>


        <br>

        {!! Form::submit('Zapisz',['class'=>'btn btn-outline-primary']) !!}
        {!! link_to(URL::previous(),'Powrót',['class'=> 'btn btn-outline-secondary']) !!}
    </div>


    {!! Form::close() !!}
@endsection
