@extends('layout')


@section('page_info')
    {{ __('Plan lekcji:') }}
    {{\App\Models\Classes::find($id)->name}}
@endsection


@section('content')
    <div class="card-header">
        <p style="text-align: left">
            @if(Auth()->user()->hasAnyRole(['Administrator']))
            <a class="btn btn-info" href="{{ route('schedules.edit', $id) }}">Edytuj plan lekcji</a>
            @endif
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

                $subjects_id = NULL;
                $day_of_week = DB::table('schedules')->where([
                    ['time','=',$i],
                    ['day','=',$j],
                    ['classes_id','=',$id]
                ])->get();
                foreach($day_of_week as $day){
                $subjects_id = $day->subjects_id;
                }
                $subject = DB::table('subjects')->where('id','=',$subjects_id)->first();
                echo "<td>";

                ?>

                {{$subject->name ?? " --- "}}
        <?php

                echo "</td>";

                }
                echo "</tr>";
            }

        ?>
        </tbody>
    </table>

@endsection
