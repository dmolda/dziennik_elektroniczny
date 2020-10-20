@extends('layout')

@section('page_info')
    Edytowany użytkownik:
    {{ \App\Models\Users::where('id','=',$user_id)->first()->name }}
@endsection

@section('content')

    <div class="card-header">
        <p style="text-align: left"> <a class="btn btn-info" href="{{route('roles.create','user_id='.$user_id)}}">Dodaj nową range</a>
            <span style="float: right">
            <a class="btn btn-info" href="{{route('users.index')}}">Powrót</a>
        </span>
        </p>
    </div>

    <table class="table table-hover">
        <tr>
            <th>ROLA</th>
            <th>OPCJE</th>
        </tr>




                    @foreach($roles_name as $role)
            <tr>
                    <td>
                        {{ $role->name }}
                    </td>
                <td>
                    {!! Form::open(['method' => 'DELETE', 'route' => ['roles.destroy', $role->id]]) !!}
                    <button class="btn btn-danger">USUŃ</button>
                    {!! Form::close() !!}</td>
            </tr>
                @endforeach




    </table>



@endsection
