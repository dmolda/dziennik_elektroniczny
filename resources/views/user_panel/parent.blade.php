
<?php
$parent_id = \App\Models\Parents::where('users_id','=',$id)->first()->id;
?>



<div id="parent">
    <div id="box">
        <p id="text"><a class="btn" href="{{route('parents.child', $parent_id)}}" role="button"><i class="far fa-user fa-3x" > Twoje dzieci </i></a></p>
        <table class='table borderless'>
            <?php
            $child_list = \App\Models\ParentsHasStudents::where('parents_id', $parent_id)->get();
            ?>
            @foreach($child_list as $child)
                <?php
                    $student_id = $child->students_id;
                $subjects = DB::select(DB::raw("SELECT DISTINCT(subjects_id) FROM `marks` WHERE updated_at >= DATE(NOW()) - INTERVAL 7 DAY AND students_id = $student_id ORDER BY updated_at ASC;"));

                ?>
                @foreach($subjects as $subject)
                    <tr><td colspan="2" style="padding-left:15%"><b>{{\App\Models\Students::find($student_id)->name}}</b></td></tr>

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
            @endforeach
        </table>
    </div>
    <div id="box">
        <p id="text"><a class="btn" href="{{route('schedules.index')}}" role="button"><i class="far fa-calendar-alt fa-3x" > Plan Lekcji </i></a></p>
        <table class='table borderless'>
            @foreach($child_list as $child)

                    <?php
                $student_id = $child->students_id;
                $class_id = \App\Models\Students::find($student_id)->classes_id;

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
                    ?>
            <tr><th style="padding-left:8%" colspan="2">{{\App\Models\Students::find($student_id)->name}}</th></tr>
                    @foreach($schedules as $schedule)
                        <tr>
                            <td style="padding-left:8%">
                                {{$schedule->time}}.{{\App\Models\Subjects::find($schedule->subjects_id)->name}}
                            </td>
                        </tr>

                    @endforeach
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

        <p id="text"><a class="btn" href="{{route('parents.child',$parent_id)}}" role="button"><i class="far fa-sticky-note fa-3x" > Uwagi</i></a></p>
        <table class='table borderless'>
            @foreach($child_list as $child)
                <?php
                $student_id = $child->students_id;
                $notes = DB::select(DB::raw("SELECT * FROM `notes` WHERE updated_at >= DATE(NOW()) - INTERVAL 7 DAY AND students_id = $student_id ORDER BY updated_at ASC;"));
                ?>

                    <tr><th style="padding-left:8%" colspan="2"><a class="btn" href="{{route('notes.show',$child->students_id)}}" role="button"><b>{{\App\Models\Students::find($student_id)->name}}</b></a></th></tr>
                    @foreach($notes as $note)
                        <tr> <td style="padding-left:8%">

                                <a class="btn" href="{{route('notes.show', $student_id)}}" role="button">Treść uwagi: {{$note->content}}</a>

                            </td></tr>
                    @endforeach
                @endforeach
        </table>
    </div>
</div>
