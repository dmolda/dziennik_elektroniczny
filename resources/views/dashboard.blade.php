<x-app-layout>

    <x-slot name="header">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">


        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <?php $id = Auth::user()->id; ?>

                    @if(Auth()->user()->hasAnyRole(['Administrator']))
                    Panel Administratora<br>
                    <a class="btn btn-info" href="{{ route('users.index') }}">Użytkownicy</a>
                    <a class="btn btn-info" href="{{ route('classes.index') }}">Klasy</a>
                    <a class="btn btn-info" href="{{ route('students.index') }}">Uczniowie</a>
                    <a class="btn btn-info" href="{{ route('teachers.index') }}">Nauczyciele</a>
                    <a class="btn btn-info" href="{{ route('subjects.index') }}">Przedmioty</a>
                    <a class="btn btn-info" href="{{ route('educators.index') }}">Wychowawcy</a>
                    @endif

                    @if(Auth()->user()->hasAnyRole(['Sekretariat']))
                            Panel Sekretariatu <br><br>
                    @endif

                    @if(Auth()->user()->hasAnyRole(['Wychowawca']))
                            Panel Wychowawcy <br>
                            <a class="btn btn-outline-primary" href="" role="button">Twoja klasa</a>
                    @endif

                    @if(Auth()->user()->hasAnyRole(['Nauczyciel']))
                        <?php $teacher_id = \App\Models\Teachers::where('users_id','=',$id)->first()->id; ?>
                            Panel Nauczyciela: <br><br>
                            <a class="btn btn-outline-primary" href="{{route('teachers.show', $teacher_id)}}" role="button">Twoje dane</a>
                            <a class="btn btn-outline-primary" href="" role="button">Dodaj ocene</a>
                            <a class="btn btn-outline-primary" href="{{route('marks.index')}}" role="button">Lista Klas</a>
                    @endif

                    @if(Auth()->user()->hasAnyRole(['Rodzic']))
                            Panel Rodzica <br><br>
                    @endif

                    @if(Auth()->user()->hasAnyRole(['Uczen']))
                        <?php $student_id = \App\Models\Students::where('users_id','=',$id)->first()->id; ?>
                            Panel Ucznia <br><br>
                            <a class="btn btn-outline-primary" href="{{route('students.show', $student_id)}}" role="button">Twoje dane</a>
                            <a class="btn btn-outline-primary" href="" role="button">Twoje Oceny</a>
                    @endif


            </div>
        </div>
    </div>
</x-app-layout>
