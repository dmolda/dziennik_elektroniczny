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
                <?php


                $id = Auth::user()->id;

                if(\App\Models\RolesHasUsers::where('users_id',$id)->get()->count() == 0) {
                    echo "Brak rangi <br>";
                    echo "Twoje konto nie zostało jeszcze aktywowane";
                }else{
                    $roles = DB::select(DB::raw("SELECT roles_id FROM roles_has_users WHERE users_id = $id ORDER BY roles_id ASC"));
                    foreach ($roles as $role){
                        //ADMIN SEKRETARIAT
                        if($role->roles_id == \App\Models\Roles::where('name','Administrator')->first()->id OR $role->roles_id == \App\Models\Roles::where('name','sekretariat')->first()->id){
                ?>
                Panel Administratora<br>
                <a class="btn btn-info" href="{{ route('users.index') }}">Użytkownicy</a>
                <a class="btn btn-info" href="{{ route('classes.index') }}">Klasy</a>
                <a class="btn btn-info" href="{{ route('students.index') }}">Uczniowie</a>
                <a class="btn btn-info" href="{{ route('teachers.index') }}">Nauczyciele</a>
                <a class="btn btn-info" href="{{ route('subjects.index') }}">Przedmioty</a>

                <br><br>

                <?php

                        }elseif($role->roles_id == \App\Models\Roles::where('name','Uczen')->first()->id) {

                            $student_id = \App\Models\Students::where('users_id',$id)->first()->id;

                            ?>

                    Panel Ucznia <br><br>
                    <a class="btn btn-outline-primary" href="" role="button">Twoje dane</a>
                    <a class="btn btn-outline-primary" href="" role="button">Twoje Oceny</a>

                    <br><br>

                    <?php



                    }elseif ($role->roles_id == \App\Models\Roles::where('name','Nauczyciel')->first()->id){

                            $teacher_id = \App\Models\Teacher::where('name','Nauczyciel')->first()->id;

                            ?>

                    Panel Nauczyciela: <br><br>
                    <a class="btn btn-outline-primary" href="" role="button">Twoje dane</a>
                    <a class="btn btn-outline-primary" href="" role="button">Dodaj ocene</a>
                    <a class="btn btn-outline-primary" href="" role="button">Lista Klas</a>


                    <?php

                    }elseif($role->roles_id == \App\Models\Roles::where('name','Wychowawca')->first()->id){
                            $teacher_id = \App\Models\Teacher::where('name','Nauczyciel')->first()->id;
                            //$educator_id =

                        ?>
                    Panel Wychowawcy <br>
                    <a class="btn btn-outline-primary" href="" role="button">Twoja klasa</a>

                    <?php
                         }
                    }
                }

                ?>
                    @if(Auth()->user()->hasAnyRole(['Administrator']))
                        test
                    @endif

            </div>
        </div>
    </div>
</x-app-layout>
