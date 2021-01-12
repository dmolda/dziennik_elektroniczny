@extends('layout')


@section('page_info')
    {{ __('Lista Klas') }}
@endsection


@section('content')
    <div class="card-header">
        <p style="text-align: left">
            @if(Auth()->user()->hasAnyRole(['Administrator']) OR Auth()->user()->hasAnyRole(['Sekretariat']))
            <a class="btn btn-info" href="{{route('lesson_hours.index')}}">Godziny lekcyjne</a>
            @endif
            <span style="float: right">
            <a class="btn btn-info" href="{{route('dashboard')}}">Powrót</a>
        </span>
        </p>
        <br><br>
    </div>

    <table class="table table-hover">
        <thead>
        <tr>
            <th>KLASA</th>
            <th>PLAN LEKCJI</th>

        </tr>
        </thead>
        <tbody>
        @foreach($classes as $class)

            <tr>

                <td>{{ $class->name }}</td>
                <td>@if(Auth()->user()->hasAnyRole(['Administrator']))
                    <a class="btn btn-info" href="{{route('schedules.show', $class->id)}}">Zarządzaj planem lekcji</a>
                    @else
                        <a class="btn btn-info" href="{{route('schedules.show', $class->id)}}">Pokaż plan lekcji</a>
                    @endif
                </td>


            </tr>
        @endforeach
        </tbody>
    </table>

@endsection
