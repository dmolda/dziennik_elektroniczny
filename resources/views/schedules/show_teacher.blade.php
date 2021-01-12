@extends('layout')


@section('page_info')
    {{ __('Lista Klas') }}
@endsection


@section('content')
    <div class="card-header">
        <p style="text-align: right">
            <span style="float: right">
            <a class="btn btn-info" href="{!! url()->previous() !!}">Powrót</a>
        </span>
        </p>
        <br><br>
    </div>

    <table class="table table-hover">
        <thead>
        <tr>
            <th>NR</th>
            <th>GODZINA</th>
            <th>PONIEDZIAŁEK</th>
            <th>WTOREK</th>
            <th>ŚRODA</th>
            <th>CZWARTEK</th>
            <th>PIĄTEK</th>


        </tr>
        </thead>
        <tbody>
        <?php
        for($i=1;$i<=12;$i++){

        echo "<tr>";
        echo "<td>" . $i . "</td>";
        echo "<td>". substr(\App\Models\LessonHours::find($i)->start_time,0,5) . "-" . substr(\App\Models\LessonHours::find($i)->end_time,0,5) . "</td>";
        for($j=1;$j<=5;$j++){
        $class_id = NULL;
        $subjects_id = NULL;
        $day_of_week = DB::table('schedules')->where([
            ['time','=',$i],
            ['day','=',$j],
            ['teachers_id','=',$id]
        ])->get();
        foreach($day_of_week as $day){
            $subjects_id = $day->subjects_id;
            $class_id = $day->classes_id;
        }
        $subject = DB::table('subjects')->where('id','=',$subjects_id)->first();
        $class = DB::table('classes')->where('id','=',$class_id)->first();
        echo "<td>";

        ?>

        {{$subject->name ?? " --- "}}
        {{$class->name ?? " --- "}}
        <?php

        echo "</td>";

        }
        echo "</tr>";
        }

        ?>
        </tbody>
    </table>

@endsection
