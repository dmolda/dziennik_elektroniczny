@extends('layout')

@section('page_info')
    {{ __('Lista uczniów') }}
@endsection

@section('content')

    <div class="card-header">
        <p style="text-align: left">
            <span style="float: right">
            <a class="btn btn-info" href="{{route('users.index')}}">Powrót</a>
        </span>
        </p>
        <br><br>
    </div>

    <table class="table table-hover">
        <tr>
            <th>IMIE(IMIONA)</th>
            <th>NAZWISKO</th>
            <th>KLASA</th>
            <th>NAZWA UŻYTKOWNIKA</th>
            <th>OPCJE</th>
        </tr>

        @foreach($student_list as $student)
            <tr>
                <td>{{ $student->name }} {{ $student->second_name }}</td>
                <td>{{$student->last_name}}</td>
                <td>{{\App\Models\Classes::find($student->classes_id)->name}}</td>
                <td>{{\App\Models\Users::find($student->users_id)->name}}</td>
                <td>
                    <a class="btn btn-info" href="{{route('students.show', $student->id)}}"><i class="fas fa-user-edit"></i></a>
                    {!! Form::open(['method' => 'DELETE', 'route' => ['students.destroy', $student->id]]) !!}
                    <button class="btn btn-danger">USUŃ(dodać)</button>
                    {!! Form::close() !!}</td>
            </tr>
        @endforeach




    </table>

    {{ $student_list->links() }}



@endsection
