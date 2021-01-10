
<?php
$student_id = \App\Models\Students::where('users_id','=',$id)->first()->id;
$class_id = \App\Models\Students::where('users_id','=',$id)->first()->classes_id;
if(date('N', strtotime(now())) > 5){
    $schedules = DB::table('schedules')->where([
        'classes_id' => $class_id,
        'day' => '1'
    ])->get();
}else{
    $schedules = DB::table('schedules')->where([
        'classes_id' => $class_id,
        'day' => date('N', strtotime(now()))
    ])->get();
}

$subjects = DB::select(DB::raw("SELECT DISTINCT(subjects_id) FROM `marks` WHERE updated_at >= DATE(NOW()) - INTERVAL 7 DAY AND students_id = $student_id ORDER BY updated_at ASC;"));
$notes = DB::select(DB::raw("SELECT * FROM `notes` WHERE updated_at >= DATE(NOW()) - INTERVAL 7 DAY AND students_id = $student_id ORDER BY updated_at ASC;"));

?>

<div id="parent">
    <div id="box">
        <p id="text"><a class="btn" href="{{route('marks.show',$student_id)}}" role="button"><i class="far fa-list-alt fa-3x" > Oceny </i></a></p>
        <table class='table borderless'>
            @foreach($subjects as $subject)
                <?php
                $subject_name = \App\Models\Subjects::find($subject->subjects_id)->name;
                $marks = DB::select(DB::raw("SELECT mark_desc FROM `marks` WHERE updated_at >= DATE(NOW()) - INTERVAL 7 DAY AND
                                                                        students_id = $student_id AND subjects_id = $subject->subjects_id ORDER BY updated_at ASC;"));

                ?>
                <tr>
                    <td style="padding-left:8%">{{$subject_name}}</td>
                    <td style="padding-left:8%">
                        @foreach($marks as $mark)

                            {{$mark->mark_desc}},

                        @endforeach
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
    <div id="box">
        <p id="text"><a class="btn" href="{{route('schedules.show', $class_id)}}" role="button"><i class="far fa-calendar-alt fa-3x" > Plan Lekcji </i></a></p>
        <table class='table borderless'>
            @foreach($schedules as $schedule)
                <tr>
                    <td style="padding-left:8%">
                        {{$schedule->time}}.{{\App\Models\Subjects::find($schedule->subjects_id)->name}}
                    </td>

                    <td style="padding-left:8%">{{ \App\Models\Teachers::find($schedule->teachers_id)->name }} {{ \App\Models\Teachers::find($schedule->teachers_id)->last_name}}</td>
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

        <p id="text"><a class="btn" href="{{route('notes.show', $student_id)}}" role="button"><i class="far fa-sticky-note fa-3x" > Uwagi</i></a></p>
        <table class='table borderless'>
            @foreach($notes as $note)
                <tr> <td style="padding-left:8%">

                        <a class="btn" href="{{route('notes.show', $student_id)}}" role="button">Treść uwagi: {{$note->content}}</a>


                    </td></tr>
            @endforeach




        </table>



    </div>
</div>
