@extends('layout')

@section('page_info')
    {{ __('Dodawanie nowego nauczyciela') }}

    {{ \App\Models\Users::find($_GET['user_id'])->name }}
@endsection

@section('content')


    {!! Form::open(['route' => 'teachers.store']) !!}

    @if ($errors->any())
        <ul class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <div class="btn btn-danger">{{ $error }}</div>
            @endforeach
        </ul>
    @endif


    <div class="form-group">
        {!! Form::label('name', "Przedmiot:") !!}
        <input type="hidden" name="users_id" value="{!! $_GET['user_id'] !!}">
        <select class="form-control" id="subjects_id" name="subjects_id">
            <?php
            $user_id = $_GET['user_id'];
            $teacher_id = \App\Models\Teachers::where('users_id','=', $user_id)->exists();
            if($teacher_id) {
                $teacher_id = \App\Models\Teachers::where('users_id', $user_id)->first()->id;

                $subjects = DB::select(DB::raw("SELECT DISTINCT(subjects.name),subjects.id FROM `subjects` ,`teachers`,`teachers_has_subjects` WHERE NOT subjects.id = ANY (SELECT subjects.id FROM ((`subjects`
                                                                                                           INNER JOIN `teachers_has_subjects` ON `subjects`.`id` = `teachers_has_subjects`.`subjects_id`)
                                                                                                           INNER JOIN `teachers` ON `subjects`.`id` = `teachers`.`id`)
                                                                                     WHERE `teachers_has_subjects`.`teachers_id` = $teacher_id)
                                                                                     "));
            }else{
                $subjects = DB::table("subjects")
                    ->select('id','name')
                    ->get();
            }

            foreach ($subjects as $subject) {
                echo "<option value='$subject->id'>". $subject->name ."</option>";
            }

            ?>


        </select>


        <br>

        {!! Form::submit('Zapisz',['class'=>'btn btn-outline-primary']) !!}
        {!! link_to(URL::previous(),'Powrót',['class'=> 'btn btn-outline-secondary']) !!}
    </div>


    {!! Form::close() !!}
@endsection
