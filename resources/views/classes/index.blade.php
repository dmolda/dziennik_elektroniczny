@extends('layout')


@section('page_info')
    {{ __('Lista Klas') }}
@endsection


@section('content')
    <div class="card-header">
        <p style="text-align: left"> <a class="btn btn-info" href="{{route('classes.create')}}">Dodaj nową klase</a>
            <span style="float: right">
            <a class="btn btn-info" href="{!! url()->previous() !!}">Powrót</a>
        </span>
        </p>
        <?php
        $faker = \Faker\Factory::create('pl_PL');

        echo $faker->firstName;
        ?>


    </div>

    <table class="table table-hover">
        <thead>
        <tr>
            <th>NAZWA</th>
            <th>OPIS</th>
            <th>LICZBA UCZNIÓW</th>
            <th>LISTA PRZEDMIOTÓW</th>
            <th>WYCHOWAWCA</th>
            <th>OPCJE</th>
        </tr>
        </thead>
        <tbody>
        @foreach($classes as $class)

            <tr>

                <td>{{ $class->name }}</td>
                <td>{{ $class->description }}</td>
                <td>{{ \App\Models\Students::where('classes_id', '=', $class->id)->count() }}
                    <a class="btn btn-info" href="{{ route('classes.show', $class->id)}}">Lista uczniów</a></td>
                <td>przedmioty</td>
                <td>wychowawca</td>
                <td>

                    <table>

                        <td>
                            <a class="btn btn-info" href="{{ route('classes.edit', $class->id)}}"><i class="fas fa-edit"></i></a>
                        </td>
                        <td>
                            {!! Form::open(['method' => 'DELETE', 'route' => ['classes.destroy', $class->id]]) !!}
                            <button class="btn btn-danger"><i class="far fa-trash-alt"></i></button>
                            {!! Form::close() !!}

                        </td>

                    </table>

                </td>

            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $classes->links() }}



@endsection
