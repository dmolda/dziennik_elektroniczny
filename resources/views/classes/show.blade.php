@extends('layout')


@section('page_info')
    {{ __('Klasa') }}
    {{ \App\Models\Classes::where('id', '=', $class->id)->first()->name }}
@endsection


@section('content')
    <div class="card-header">
        <p style="text-align: left"> <a class="btn btn-info" href="{{route('students.add')}}">Dodaj nowego ucznia</a>
            <span style="float: right">
            <a class="btn btn-info" href="{!! url()->previous() !!}">Powrót</a>
        </span>
        </p>
    </div>

    <table class="table table-hover">
        <thead>
        <tr>
            <th>IMIE(IMIONA)</th>
            <th>NAZWISKO</th>
            <th>OPCJE</th>

        </tr>
        </thead>
        <tbody>
        @foreach($students_list as $student)

            <tr>

                <td>{{ $student->name }} {{ $student->second_name }}</td>
                <td>{{ $student->last_name }}</td>
                <td>
                    <table>
                        <?php
                        $student_id = "student_id=". $student->id;
                        ?>
                        <td>
                            <a class="btn btn-info" href="{{ route('students.index', $student_id)}}"><i class="far fa-eye"></i></a>
                        </td>
                        <td>
                            <a class="btn btn-info" href="{{ route('students.edit', $student->id)}}"><i class="fas fa-user-edit"></i></a>
                        </td>
                        <td>
                            {!! Form::open(['method' => 'DELETE', 'route' => ['classes.destroy', $student->id]]) !!}
                            <button class="btn btn-danger"><i class="far fa-trash-alt"></i></button>
                            {!! Form::close() !!}
                        </td>
                    </table>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>



@endsection
