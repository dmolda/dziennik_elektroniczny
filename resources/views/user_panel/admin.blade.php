<?php
$users_with_role = DB::table('users')
                        ->join('roles_has_users','users.id','=','roles_has_users.users_id')
                        ->get();
$all_users = \App\Models\Users::all();
$users_without_role = count(\App\Models\Users::all()) - count($users_with_role);



?>



<div id="parent">
    <div id="box">
        <p id="text"><a class="btn" href="{{ route('users.index') }}" role="button"><i class="far fa-user fa-3x" > Użytkownicy </i></a></p>

        <p id="text">
            Lista użytkowników bez rangi: {{$users_without_role}} <br>
            Ogólna liczba użytkowników: {{count(\App\Models\Users::all())}} <br>

            <a class="btn" href="{{ route('users.create') }}" role="button"> Dodaj nowego użytkownika </a>
        </p>
    </div>
    <div id="box">
        <p id="text"><a class="btn" href="{{ route('classes.index') }}" role="button"><i class="far fa-address-book fa-3x" > Klasy </i></a></p>

        <p id="text">Liczba klas: {{count(\App\Models\Classes::all())}} <br>
            <a class="btn" href="{{ route('classes.create') }}" role="button"> Dodaj nową klase </a>
        </p>


    </div>

    <div id="box">

        <p id="text"><a class="btn" href="{{route('messages.index')}}" role="button"><i class="far fa-comment-dots fa-3x" > Wiadomości</i></a></p>
        <table class='table borderless' id="text">
            <tr> <td style="padding-left:8%">
                    <a class="btn" href="{{route('messages.index')}}" role="button">Masz {{$new_message}} nowe wiadomości</a>
                </td></tr>
            <tr><td style="padding-left:8%">
                    <a class="btn" href="{{route('messages.create')}}" role="button">Napisz nową wiadomość</a>
                </td></tr>

        </table>


    </div>
</div>

<div id="parent">
    <div id="box">
        <p id="text"><a class="btn" href="{{ route('teachers.index') }}" role="button"><i class="far fa-user fa-3x" > Nauczyciele </i></a></p>

        <p id="text">Lista nauczycieli: {{count(\App\Models\Teachers::all())}}</p>
    </div>
    <div id="box">
        <p id="text"><a class="btn" href="{{ route('subjects.index') }}" role="button"><i class="far fa-address-book fa-3x" > Przedmioty </i></a></p>

        <p id="text">Liczba przedmiotów: {{count(\App\Models\Subjects::all())}}<br>
            <a class="btn" href="{{ route('subjects.create') }}" role="button"> Dodaj nowy przedmiot</a></p>


    </div>



    <div id="box">

        <p id="text"><a class="btn" href="{{ route('educators.index') }}" role="button"><i class="far fa-user-circle fa-3x" > Wychowawcy</i></a></p>
        <p id="text">Liczba wychowawców: {{count(\App\Models\Educators::all())}}<br>
            <a class="btn" href="{{ route('educators.create') }}" role="button"> Dodaj nowego wychowawcę </a></p>



    </div>



</div>
<div id="parent">
    <div id="box">

        <p id="text"><a class="btn" href="{{ route('parents.index') }}" role="button"><i class="far fa-user-circle fa-3x" > Rodzice</i></a></p>
        <p id="text">Liczba rodziców: {{count(\App\Models\Parents::all())}}</p>



    </div>

    <div id="box">

        <p id="text"><a class="btn" href="{{ route('students.index') }}" role="button"><i class="far fa-user-circle fa-3x" > Uczniowie</i></a></p>
        <p id="text">Liczba uczniów: {{count(\App\Models\Students::all())}}</p>



    </div>

    <div id="box">

        <p id="text"><a class="btn" href="{{ route('schedules.index') }}" role="button"><i class="far fa-user-circle fa-3x" > Plan lekcji</i></a></p>

    </div>
</div>
