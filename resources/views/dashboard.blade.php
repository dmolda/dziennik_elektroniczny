<x-app-layout>

    <x-slot name="header">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://kit.fontawesome.com/40fd0fe410.js" crossorigin="anonymous"></script>

        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

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
                        <?php $student_id = \App\Models\Students::where('users_id','=',$id)->first()->id; $class_id = \App\Models\Students::where('users_id','=',$id)->first()->classes_id;?>
                            Panel Ucznia <br><br>
                            <a class="btn btn-outline-primary" href="{{route('students.show', $student_id)}}" role="button">Twoje dane</a>
                            <a class="btn btn-outline-primary" href="{{route('marks.show',$student_id)}}" role="button">Twoje Oceny</a>
                            <a class="btn btn-outline-primary" href="{{route('schedules.show', $class_id)}}" role="button">Plan lekcji</a>
                            @if($new_message > 0)
                                <a class="btn btn-outline-primary" href="{{route('messages.index')}}">Wiadomości!!!<i class="far fa-comments"></i></a>
                                <a class="btn btn-info" href="{{route('messages.index')}}"><i class="fas fa-user-edit"></i></a>
                            @else
                                <a class="btn btn-outline-primary" href="{{route('messages.index')}}">Wiadomości</a>
                            @endif
                    @endif


            </div>
        </div>
    </div>
</x-app-layout>
