@extends('layout')


@section('page_info')
    {{ __('Lista Klas') }}
@endsection


@section('content')


    <div class="card-header">
        <p style="text-align: right">
            <span style="float: right">
            <a class="btn btn-info" href="{{route('dashboard')}}">Powrót</a>
        </span>
            <br><br>
        </p>

    </div>

    <table class="table table-hover">
        <tr>
            <th>KLASA</th>
            <th>PRZEDMIOT</th>
            <th>OPCJE</th>
        </tr>
        @foreach($class_list as $class)
            <tr>
                <td>{{$class->classes_name}}</td>
                <td>{{$class->subjects_name}}</td>
                <td><a class="btn btn-outline-primary" href="{{ route('marks.show_class', $class->classes_has_subjects_id) }}" role="button">Pokaż uczniów</a></td>



            </tr>
        @endforeach
    </table>



@endsection


