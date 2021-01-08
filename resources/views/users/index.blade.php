@extends('layout')


@section('page_info')
    {{ __('Lista Użytkowników') }}
@endsection


@section('content')


    <div class="card-header">
        <p style="text-align: left"> <a class="btn btn-info" href="{{route('users.create')}}">Dodaj nowego użytkownika</a>
        <span style="float: right">
            <a class="btn btn-info" href="{{route('dashboard')}}">Powrót</a>
        </span>
        </p>

    </div>

    <table class="table table-hover">
        <tr>
            <th>NAZWA UŻYTKOWNIKA</th>
            <th>E-MAIL</th>
            <th>ROLE</th>
            <th>OPCJE</th>
        </tr>
        @foreach($users as $user)
            <tr>

                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td><?php

                    $ilosc_rol = DB::table('roles_has_users')
                        ->where('users_id','=',$user->id)
                        ->count('*');

                    $roles_name = DB::table('roles_has_users')
                        ->join('roles','roles_id','=','roles.id')
                        ->join('users','users_id','=','users.id')
                        ->select('roles.name')
                        ->where('roles_has_users.users_id','=',$user->id)
                        ->get();

                        if ($ilosc_rol == 0){
                            echo "Nowy";
                        }else{
                            foreach ($roles_name as $role){
                                echo $role->name . " <br>";
                            }
                        }

                    $user_id = "user_id=".$user->id;
                    ?><br>
                    <a class="btn btn-info" href="{{ route('roles.index', $user_id  )}}">Zarządzaj rolami</a></td>
                <td>

                    <table>
                        <td>
                            <a class="btn btn-info" href="{{ route('users.edit', $user->id)}}"><i class="fas fa-user-edit"></i></a>
                        </td>

                        <td>
                            {!! Form::open(['method' => 'DELETE', 'route' => ['users.destroy', $user->id]]) !!}
                            <button class="btn btn-danger" onclick="return confirm('Potwierdź usunięcie użytkownika!')"><i class="far fa-trash-alt"></i></button>
                            {!! Form::close() !!}

                        </td>

                        <td>
                            <a class="btn btn-info" href="{{ route('messages.show_user_message', $user->id)}}"><i class="far fa-envelope-open"></i></a>
                        </td>

                    </table>

                </td>

            </tr>
        @endforeach
    </table>
    {{ $users->links() }}


@endsection


