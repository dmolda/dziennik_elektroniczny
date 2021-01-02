@extends('layout')


@section('page_info')
    {{ __('Lista Klas') }}
@endsection


@section('content')
    <div class="card-header">
        <p style="text-align: right">
            <span style="float: right">
            <a class="btn btn-info" href="{!! url()->previous() !!}">Powrót</a>
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
                <td><a class="btn btn-info" href="{{route('schedules.show', $class->id)}}">Zarządzaj planem lekcji</a></td>

            </tr>
        @endforeach
        </tbody>
    </table>

@endsection
