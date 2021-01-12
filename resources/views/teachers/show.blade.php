@extends('layout')

@section('page_info')
    {{ __('Nauczyciel:') }}
    {{ $teacher->name }}
    {{ $teacher->last_name }}
@endsection

@section('content')

    <div class="card-header">
        <p style="text-align: left">
            @if(Auth()->user()->hasAnyRole(['Administrator']))
                <a class="btn btn-info" href="{{route('teachers.edit', $teacher->id)}}">Edytuj</a>
            @endif
            @if(isset($teacher->name))

            @else
                <a class="btn btn-info" href="{{route('teachers.edit', $teacher->id)}}">Edytuj</a>
            @endif
            <span style="float: right">
            <a class="btn btn-info" href="{{route('teachers.index')}}">Powrót</a>
        </span><br><br>
        </p>
    </div>

    <table class="table table-hover">

        <tr>
            <th>Imie:</th>
            <td>{{$teacher->name}}</td>

        </tr>

        <tr>
            <th>Drugie imie:</th>
            <td>{{$teacher->second_name}}</td>

        </tr>

        <tr>
            <th>Nazwisko:</th>
            <td>{{$teacher->last_name}}</td>

        </tr>

        <tr>
            <th>Data urodzenia:</th>
            <td>{{$teacher->date_of_birth}}</td>

        </tr>

        <tr>
            <th>Płeć:</th>
            <td>{{$teacher->sex}}</td>

        </tr>





    </table>




@endsection
