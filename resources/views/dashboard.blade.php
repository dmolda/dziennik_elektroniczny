<x-app-layout>

    <x-slot name="header">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://kit.fontawesome.com/40fd0fe410.js" crossorigin="anonymous"></script>

        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <style>
        #parent {
            display: flex;
        }
        #text {
            padding: 7%;
        }
        #box {
            width: 33%;
            background: #F2ECA7;

            -webkit-box-shadow: inset 0 0 20px 10px white;
            box-shadow: inset 0 0 20px 10px white;
        }
        .borderless td, .borderless th {
            border: none;
        }



    </style>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <?php $id = Auth::user()->id;
                $new_message = DB::table('messages')->where([
                    'recipient' => Auth::user()->id,
                    'status' => 'new'
                ])->count();
                ?>

                    @if(Auth()->user()->hasAnyRole(['Administrator']))
                    Panel Administratora<br>


                    <a class="btn btn-info" href="{{ route('users.index') }}">Użytkownicy</a>
                    <a class="btn btn-info" href="{{ route('classes.index') }}">Klasy</a>
                    <a class="btn btn-info" href="{{ route('students.index') }}">Uczniowie</a>
                    <a class="btn btn-info" href="{{ route('teachers.index') }}">Nauczyciele</a>
                    <a class="btn btn-info" href="{{ route('subjects.index') }}">Przedmioty</a>
                    <a class="btn btn-info" href="{{ route('educators.index') }}">Wychowawcy</a>
                        <a class="btn btn-info" href="{{ route('parents.index') }}">Rodzice</a>
                        <a class="btn btn-info" href="{{ route('schedules.index') }}">Plan lekcji</a>
                        @if($new_message > 0)
                            <a class="btn btn-info" href="{{route('messages.index')}}" role="button"><i class="far fa-comments"></i> Wiadomości</a>
                        @else
                            <a class="btn btn-info" href="{{route('messages.index')}}" role="button">Wiadomości</a>
                        @endif
                    @endif

                    @if(Auth()->user()->hasAnyRole(['Sekretariat']))
                            Panel Sekretariatu <br><br>
                    @endif

                    @if(Auth()->user()->hasAnyRole(['Wychowawca']))
                        <?php
                        $teacher_id = \App\Models\Teachers::where('users_id','=',$id)->first()->id;
                        $educator_id = \App\Models\Educators::where('teachers_id','=',$teacher_id)->first()->id;

                        ?>
                            Panel Wychowawcy <br>
                            <a class="btn btn-outline-primary" href="{{route('educators.show',$educator_id)}}" role="button">Twoja klasa</a>
                        @if($new_message > 0)
                            <a class="btn btn-outline-primary" href="{{route('messages.index')}}" role="button"><i class="far fa-comments"></i>Wiadomości</a>
                            @else
                                <a class="btn btn-outline-primary" href="{{route('messages.index')}}" role="button">Wiadomości</a>
                            @endif
                    @endif

                    @if(Auth()->user()->hasAnyRole(['Nauczyciel']))
                        <?php $teacher_id = \App\Models\Teachers::where('users_id','=',$id)->first()->id; ?>


                            Panel Nauczyciela: <br><br>
                            <a class="btn btn-outline-primary" href="{{route('teachers.show', $teacher_id)}}" role="button">Twoje dane</a>
                            <a class="btn btn-outline-primary" href="{{route('marks.index')}}" role="button">Lista Klas</a>
                            <a class="btn btn-outline-primary" href="{{route('notes.index')}}" role="button">Uwagi</a>
                            <a class="btn btn-outline-primary" href="{{route('schedules.show_teacher', $teacher_id)}}" role="button">Plan lekcji nauczyciela</a>
                            @if($new_message > 0)
                                <a class="btn btn-outline-primary" href="{{route('messages.index')}}" role="button"><i class="far fa-comments"></i>Wiadomości</a>
                            @else
                                <a class="btn btn-outline-primary" href="{{route('messages.index')}}" role="button">Wiadomości</a>
                            @endif
                    @endif

                    @if(Auth()->user()->hasAnyRole(['Rodzic']))
                            Panel Rodzica <br><br>
                        <?php
                        $parent_id = \App\Models\Parents::where('users_id','=',$id)->first()->id;
                        ?>
                        <a class="btn btn-outline-primary" href="{{route('parents.show', $parent_id)}}" role="button">Twoje dane</a>
                        <a class="btn btn-outline-primary" href="{{route('parents.child', $parent_id)}}" role="button">Twoje dzieci</a>
                        @if($new_message > 0)
                            <a class="btn btn-outline-primary" href="{{route('messages.index')}}" role="button"><i class="far fa-comments"></i>Wiadomości</a>
                        @else
                            <a class="btn btn-outline-primary" href="{{route('messages.index')}}" role="button">Wiadomości</a>
                        @endif
                    @endif

                    @if(Auth()->user()->hasAnyRole(['Uczen']))
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
                        $actual_subject = 0;
                        $tr = "close";
                        ?>
                            Panel Ucznia <br><br>

                            <div id="parent">
                                <div id="box">
                                    <p id="text"><a class="btn" href="{{route('marks.show',$student_id)}}" role="button"><i class="far fa-list-alt fa-3x" > Oceny </i></a></p>
                                    <hr>
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

                                                    {{$mark->mark_desc}}

                                                    @endforeach
                                                </td>
                                            </tr>
                                            @endforeach
                                    </table>
                                </div>
                                <div id="box">
                                    <p id="text"><a class="btn" href="{{route('schedules.show', $class_id)}}" role="button"><i class="far fa-calendar-alt fa-3x" > Plan Lekcji </i></a></p>
                                    <hr>
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

                                        <p id="text"><a class="btn" href="{{route('messages.index')}}" role="button"><i class="far fa-calendar-alt fa-3x" > Wiadomości</i></a></p>
                                        <hr>
                                    <table class='table borderless'>
                                        <tr> <td style="padding-left:8%">
                                    <a class="btn" href="{{route('messages.index')}}" role="button">Masz {{$new_message}} nowe wiadomości</a>
                                            </td></tr>
                                        <tr><td style="padding-left:8%">
                                            <a class="btn" href="{{route('messages.create')}}" role="button">Napisz nową wiadomość</a>
                                            </td></tr>

                                    </table>



                                </div>
                            </div>


                            <a class="btn btn-outline-primary" href="{{route('students.show', $student_id)}}" role="button">Twoje dane</a>
                            <a class="btn btn-outline-primary" href="{{route('marks.show',$student_id)}}" role="button">Twoje Oceny</a>
                            <a class="btn btn-outline-primary" href="{{route('schedules.show', $class_id)}}" role="button">Plan lekcji</a>
                            @if($new_message > 0)
                                <a class="btn btn-outline-primary" href="{{route('messages.index')}}">Wiadomości!!!<i class="far fa-comments"></i></a>
                            @else
                                <a class="btn btn-outline-primary" href="{{route('messages.index')}}">Wiadomości</a>
                            @endif
                    @endif

            </div>
        </div>
    </div>
</x-app-layout>
