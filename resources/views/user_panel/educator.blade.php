<?php
    $teacher_id = \App\Models\Teachers::where('users_id','=',$id)->first()->id;
    $educator_id = \App\Models\Educators::where('teachers_id','=',$teacher_id)->first()->id;
    $educator_class = \App\Models\Educators::where('teachers_id','=',$teacher_id)->first()->classes_id;
    if(date('N', strtotime(now())) > 5){
        $schedules = DB::table('schedules')->where([
            'classes_id' => $educator_class,
            'day' => '1'
        ])->get();
    }else{
        $schedules = DB::table('schedules')->where([
            'classes_id' => $educator_class,
            'day' => date('N', strtotime(now()))
        ])->get();
    }
    $students_list = \App\Models\Students::where('classes_id',$educator_class)->get()
?>

<div id="parent">
    <div id="box">
        <p id="text"><a class="btn" href="{{route('educators.show',$educator_id)}}" role="button"><i class="far fa-list-alt fa-3x" > Oceny </i></a></p>
        <table class='table borderless'>

            @foreach($students_list as $student)
                <?php
                $student_id = $student->id;
                $subjects = DB::select(DB::raw("SELECT DISTINCT(subjects_id) FROM `marks` WHERE updated_at >= DATE(NOW()) - INTERVAL 7 DAY AND students_id = $student_id ORDER BY updated_at ASC;"));

                ?>
                @foreach($subjects as $subject)
                    <tr><td colspan="2" style="padding-left:8%"><b>{{\App\Models\Students::find($student_id)->name}} {{\App\Models\Students::find($student_id)->last_name}}</b></td>

                    <?php
                    $subject_name = \App\Models\Subjects::find($subject->subjects_id)->name;
                    $marks = DB::select(DB::raw("SELECT mark_desc FROM `marks` WHERE updated_at >= DATE(NOW()) - INTERVAL 7 DAY AND
                                                                            students_id = $student_id AND subjects_id = $subject->subjects_id ORDER BY updated_at ASC;"));

                    ?>
                        <td style="padding-left:8%">{{$subject_name}}</td>
                        <td style="padding-left:8%">
                            @foreach($marks as $mark)

                                {{$mark->mark_desc}},

                            @endforeach
                        </td>
                    </tr>
                @endforeach
            @endforeach
        </table>
    </div>
    <div id="box">
        <p id="text"><a class="btn" href="{{route('schedules.show',$educator_class)}}" role="button"><i class="far fa-calendar-alt fa-3x" > Plan Lekcji Twojej Klasy</i></a></p>
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

        <p id="text"><a class="btn" href="" role="button"><i class="far fa-sticky-note fa-3x" > Uwagi</i></a></p>
        <table class='table borderless'>
            @foreach($students_list as $student)
                <?php
                $student_id = $student->id;
                $notes = DB::select(DB::raw("SELECT * FROM `notes` WHERE updated_at >= DATE(NOW()) - INTERVAL 7 DAY AND students_id = $student_id ORDER BY updated_at ASC;"));
                ?>

                @foreach($notes as $note)
                    @if($i == 0)
                        <?php $i=1;?>
                            <tr><th style="padding-left:8%" colspan="2"><a class="btn" href="{{route('notes.show',$student_id)}}" role="button"><b>{{\App\Models\Students::find($student_id)->name}} {{\App\Models\Students::find($student_id)->last_name}}</b></a></th></tr>
                        @endif
                    <tr> <td style="padding-left:8%">

                            <a class="btn" href="{{route('notes.show', $student_id)}}" role="button">Treść uwagi: {{$note->content}}</a>


                        </td></tr>

                @endforeach
                    <?php $i=0;?>
            @endforeach

        </table>
    </div>
</div>
