<?php

    $teacher_id = \App\Models\Teachers::where('users_id','=',$id)->first()->id;

    if(date('N', strtotime(now())) > 5){
        $schedules = DB::table('schedules')->where([
            'teachers_id' => $teacher_id,
            'day' => '1'
        ])
            ->orderBy('time','ASC')
            ->get();
    }else{
        $schedules = DB::table('schedules')->where([
            'teachers_id' => $teacher_id,
            'day' => date('N', strtotime(now()))
        ])
            ->orderBy('time','ASC')
            ->get();
    }
    ?>
<div id="parent">
    <div id="box">
        <p id="text"><a class="btn" href="{{route('marks.index')}}" role="button"><i class="far fa-list-alt fa-3x" > Lista klas </i></a></p>
        <p id="text"><a class="btn" href="{{route('schedules.index')}}" role="button"><i class="far fa-calendar-alt fa-3x" > Plan Lekcji </i></a></p>

    </div>
    <div id="box">
        <p id="text"><a class="btn" href="{{route('schedules.show_teacher', $teacher_id)}}" role="button"><i class="far fa-calendar-alt fa-3x" > Twój plan lekcji</i></a></p>
        <table class='table borderless' id="text">

                @foreach($schedules as $schedule)
                    <tr>
                        <td style="padding-left:8%">
                            {{$schedule->time}}.{{\App\Models\Subjects::find($schedule->subjects_id)->name}}:{{\App\Models\Classes::find($schedule->classes_id)->name}}
                        </td>
                    </tr>

                @endforeach

        </table>

    </div>

    <div id="box">

        <p id="text"><a class="btn" href="{{route('messages.index')}}" role="button"><i class="far fa-comment-dots fa-3x" > Wiadomości</i></a></p>
        <table class='table borderless'>
            <tr> <td style="padding-left:8%">
                    <a class="btn" href="{{route('messages.index')}}" role="button">Masz {{$new_message}} nowe wiadomości</a>
                </td></tr>
            <tr><td style="padding-left:8%">
                    <a class="btn" href="{{route('messages.create')}}" role="button">Napisz nową wiadomość</a>
                </td></tr>

        </table>



    </div>

    <div id="box">

        <p id="text"><a class="btn" href="{{route('notes.index')}}" role="button"><i class="far fa-sticky-note fa-3x" > Uwagi</i></a></p>
        <table class='table borderless'>

        </table>

    </div>
</div>

