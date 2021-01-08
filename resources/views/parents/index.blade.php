@extends('layout')

@section('page_info')
    {{ __('Lista rodziców') }}
@endsection

@section('content')

    <div class="card-header">
        <p style="text-align: left">
            <span style="float: right">
            <a class="btn btn-info" href="{{route('dashboard')}}">Powrót</a>
        </span>
            <br><br>
        </p>
    </div>

    <table class="table table-hover">
        <tr>
            <th>IMIE(IMIONA)</th>
            <th>NAZWISKO</th>
            <th>DZIECI</th>
            <th>NAZWA UŻYTKOWNIKA</th>
            <th>OPCJE</th>
        </tr>

        @foreach($parents_list as $parent)
            <tr>
                <td>{{ $parent->name }} {{ $parent->second_name }}</td>
                <td>{{$parent->last_name}}</td>
                <td>Liczba dzieci: <b>{{\App\Models\ParentsHasStudents::where('parents_id','=',$parent->id)->count()}}</b><br>
                    <a class="btn btn-info" href="{{route('parents.child_manage', $parent->id)}}">Zarządzaj dziećmi</a>
                </td>
                <td>{{\App\Models\Users::find($parent->users_id)->name}}</td>
                <td>
                    <a class="btn btn-info" href="{{route('parents.show', $parent->id)}}"><i class="fas fa-user-edit"></i></a>
                    <a class="btn btn-info" href="{{route('parents.create', 'parents_id='.$parent->id)}}"><i class="fas fa-user-graduate"></i></a>
                    {!! Form::open(['method' => 'DELETE', 'route' => ['parents.destroy', $parent->id]]) !!}
                    <button class="btn btn-danger">USUŃ(dodać)</button>
                    {!! Form::close() !!}</td>
            </tr>
        @endforeach




    </table>

    {{ $parents_list->links() }}



@endsection
