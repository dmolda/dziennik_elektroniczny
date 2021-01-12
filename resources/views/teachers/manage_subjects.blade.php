@extends('layout')

@section('page_info')
    Przedmioty nauczyciela: {{ \App\Models\Teachers::find($id)->name }} {{ \App\Models\Teachers::find($id)->last_name }}
@endsection

@section('content')

    <div class="card-header">
        <p style="text-align: left"><a class="btn btn-info" href="{{route('teachers.create', 'user_id=' . \App\Models\Teachers::find($id)->users_id)}}">Dodaj przedmiot</a>
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




        @foreach($subjects as $subject)
            <tr>
                <td>
                    {{ \App\Models\Subjects::find($subject->subjects_id)->name }}
                </td>
                <td>
                    {!! Form::open(['method' => 'DELETE', 'route' => ['teachers_has_subjects.destroy', $subject->id]]) !!}
                    <button class="btn btn-danger" onclick="return confirm('Potwierdź usunięcie przedmiotu!')">USUŃ</button>
                    {!! Form::close() !!}</td>
            </tr>
        @endforeach




    </table>



@endsection
