@extends('layout')


@section('page_info')
    {{ __('Godziny lekcyjne') }}
@endsection


@section('content')
    <script src="{{asset('js/jquery.js')}}"></script>

    <div class="card-header">

        <p style="text-align: left">


            <a class="btn btn-info" href="{{route('lesson_hours.edit', 1)}}">Edytuj</a>

            <span style="float: right">
            <a class="btn btn-info" href="{{route('dashboard')}}">Powrót</a>
        </span>
        </p>

    </div>

    <table class="table table-hover">
        <tr>
            <th>LEKCJA</th>
            <th>GODZINA ROZPOCZĘCIA</th>
            <th>GODZINA ZAKOŃCZENIA</th>
        </tr>
        <tbody></tbody>
        @foreach($lesson_hours as $hour)
            <tr>

                <td>{{ $hour->time }}</td>
                <td>{{ $hour->start_time }}</td>
                <td>{{ $hour->end_time }}</td>

            </tr>
        @endforeach
    </table>


@endsection


