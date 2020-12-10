@extends('layout')

@section('page_info')
    Dodawanie wychowawcy

@endsection

@section('content')

    <div class="card-header">
        <p style="text-align: left">
            <span style="float: right">
            <a class="btn btn-info" href="{!! url()->previous() !!}">Powrót</a>
        </span>
        </p>
        <br>
    </div>

    <table class="table table-hover">


        {!! Form::open(['route'=>'educators.store']) !!}
        <div class="form-group">
            {!! Form::label('role', "Wybierz nauczyciela:") !!}

            <select class="form-control" id="teachers_id" name="teachers_id">
                <option value="" disabled selected>Wybierz nauczyciela</option>
                <?php
            $teachers_list = DB::SELECT(DB::raw("SELECT `id`,`name`,`second_name`,`last_name` FROM `teachers` WHERE teachers.id NOT IN ( SELECT teachers_id FROM educators)"));
                foreach ($teachers_list as $teacher) {
                    echo "<option value='$teacher->id'>" . $teacher->name . " " . $teacher->second_name . " " . $teacher->last_name . "</option>";
                }
                ?>
            </select>
            {!! Form::label('role', "Wybierz klase:") !!}
            <select class="form-control" id="classes_id" name="classes_id">
                <option value="" disabled selected>Wybierz klase</option>
                <?php
                $classes_list = DB::SELECT(DB::raw("SELECT `id`,`name` FROM `classes` WHERE classes.id NOT IN ( SELECT classes_id FROM educators)"));
                foreach ($classes_list as $classes) {
                    echo "<option value='$classes->id'>" . $classes->name . "</option>";
                }
                ?>
            </select>
            <br>

            {!! Form::submit('Zapisz',['class'=>'btn btn-outline-primary']) !!}

        </div>

        {!! Form::close() !!}

    </table>



@endsection
