@extends('layout')

@section('page_info')
    {{ __('Profil rodzica') }}
@endsection

@section('content')

    <div class="card-header">
        <p style="text-align: left">
            @if(Auth()->user()->hasAnyRole(['Administrator']))
                <a class="btn btn-info" href="{{route('parents.edit', $parent->id)}}">Edytuj</a>
            @endif

            @if(isset($parent->name))

                @else
            <a class="btn btn-info" href="{{route('parents.edit', $parent->id)}}">Edytuj</a>
            @endif
            <span style="float: right">
            <a class="btn btn-info" href="{{route('parents.index')}}">Powrót</a>
        </span><br><br>
        </p>
    </div>

    <table class="table table-hover">

        <tr>
            <th>Imie:</th>
            <td>{{$parent->name}}</td>

        </tr>

        <tr>
            <th>Drugie imie:</th>
            <td>{{$parent->second_name}}</td>

        </tr>

        <tr>
            <th>Nazwisko:</th>
            <td>{{$parent->last_name}}</td>

        </tr>

        <tr>
            <th>Data urodzenia:</th>
            <td>{{$parent->date_of_birth}}</td>

        </tr>

        <tr>
            <th>Płeć:</th>
            <td>{{$parent->sex}}</td>

        </tr>





    </table>




@endsection
