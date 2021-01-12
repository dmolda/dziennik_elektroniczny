@extends('layout')

@section('page_info')
    {{ __('Uczeń:') }}
    {{$student->name}}
    {{$student->last_name}}
@endsection

@section('content')

    <div class="card-header">
        <p style="text-align: left">
            @if(Auth()->user()->hasAnyRole(['Administrator']))
                <a class="btn btn-info" href="{{route('students.edit', $student->id)}}">Edytuj</a>
            @endif

            @if(isset($student->name))

            @else
                <a class="btn btn-info" href="{{route('students.edit', $student->id)}}">Edytuj</a>
            @endif
            <span style="float: right">
            <a class="btn btn-info" href="{{route('students.index')}}">Powrót</a>
        </span><br><br>
        </p>
    </div>

    <table class="table table-hover">

        <tr>
            <th>Imie:</th>
            <td>{{$student->name}}</td>

        </tr>

        <tr>
            <th>Drugie imie:</th>
            <td>{{$student->second_name}}</td>

        </tr>

        <tr>
            <th>Nazwisko:</th>
            <td>{{$student->last_name}}</td>

        </tr>

        <tr>
            <th>Data urodzenia:</th>
            <td>{{$student->date_of_birth}}</td>

        </tr>

        <tr>
            <th>Płeć:</th>
            <td>{{$student->sex}}</td>

        </tr>





    </table>




@endsection
