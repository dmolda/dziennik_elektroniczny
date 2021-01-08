@extends('layout')


@section('page_info')
    {{ __('Klasa') }}
{{--    {{ \App\Models\Classes::where('id', '=', $class->id)->first()->name }}--}}
@endsection


@section('content')
    <div class="card-header">
        <p style="text-align: left">
{{--            <a class="btn btn-info" href="{{route('students.add', $class->id)}}">Dodaj nowego ucznia</a>--}}
            <span style="float: right">
            <a class="btn btn-info" href="{!! url()->previous() !!}">Powrót</a>
        </span>
        </p>
        <br><br>
    </div>

    <table class="table table-hover">
        <thead>
        <tr>
            <th colspan="2"><center>Lista uczniów</center></th>

        </tr>
        <tr>
            <th>UCZEŃ</th>
            <th>OCENY</th>

        </tr>
        </thead>
        <tbody>
        @foreach($students_list as $student)

            <tr>

                <td>{{ $student->name }} {{ $student->second_name }} {{ $student->last_name }}</td>
                <td>
                    <a class="btn btn-info" href="{{route('marks.show',$student->id)}}" role="button">Pokaż oceny</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <table class="table table-hover">
        <thead>
        <tr>
            <th colspan="2"><center>Lista przedmiotów</center></th>

        </tr>
        <tr>
            <th>PRZEDMIOT</th>
            <th>OPCJA</th>

        </tr>
        </thead>
        <tbody>
        @foreach($subjects_list as $subject)

            <tr>

                <td>{{\App\Models\Subjects::find($subject->subjects_id)->name}}</td>
                <td>
                    <a class="btn btn-info" href="{{route('marks.show_class',$subject->id)}}" role="button">{{$subject->id}}Pokaż oceny</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection
