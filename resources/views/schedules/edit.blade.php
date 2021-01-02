@extends('layout')


@section('page_info')
    {{ __('Lista Klas') }}
@endsection


@section('content')
    {!! Form::model($id, ['route' => ['schedules.update', $id], 'method' => 'PUT']) !!}

    <table class="table table-hover">
        <thead>
        <tr>
            <th>LEKCJA</th>
            <th>PONIEDZIAŁEK</th>
            <th>WTOREK</th>
            <th>ŚRODA</th>
            <th>CZWARTEK</th>
            <th>PIĄTEK</th>


        </tr>
        </thead>



        <?php
        for($i=1;$i<=12;$i++){
        echo "<tr>";
        echo "<td>" . $i . "</td>";
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
        $saved_subject = DB::table('subjects')->where('id','=',$subjects_id)->first();
        echo "<td>";

        $select_name = $i . "|" . $j;
        $del = 0;
        ?>

        <select class="form-control" id='{{$select_name}}' name='{{$select_name}}'>
            <option disabled selected value="">- Wybierz przedmiot -</option>
            @foreach($subjects as $subject)
                @if(!empty($saved_subject))
                    @if($saved_subject->name == $subject->name)
                        <?php $del = 1; ?>
                        <option selected="selected" value='{{$subject->id}}'>{{$subject->name}} {{$subject->teachers_name}} {{$subject->second_name}} {{$subject->last_name}}</option>

                    @else
                        <option value='{{$subject->id}}'>{{$subject->name}} {{$subject->teachers_name}} {{$subject->second_name}} {{$subject->last_name}}</option>
                    @endif
                @else
                    <option value='{{$subject->id}}'>{{$subject->name}} {{$subject->teachers_name}} {{$subject->second_name}} {{$subject->last_name}}</option>
                @endif


            @endforeach
            @if($del == 1)
                <option value='DELETE'>USUŃ</option>
            @endif

        </select>
        <?php

        echo "</td>";

        }
        echo "</tr>";
        }

        ?>
        <tr>
            <td colspan="6">
                <center>
                    {!! Form::submit('Zapisz',['class'=>'btn btn-outline-primary']) !!}
        <a class="btn btn-outline-secondary" href="{{ route('users.index') }}" role="button">Powrót</a>
                </center>
            </td>
        </tr>
        {!! Form::close() !!}

        </tbody>

    </table>


@endsection
