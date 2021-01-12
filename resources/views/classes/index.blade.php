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
    </div>

    <table class="table table-hover">
        <thead >
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
                <td>Liczba uczniów: {{ \App\Models\Students::where('classes_id', '=', $class->id)->count() }}
                    <a class="btn btn-info" href="{{ route('classes.show', $class->id)}}">Lista uczniów</a></td>
                <td>Liczba przedmiotów: {{ \App\Models\ClassesHasSubjects::where('classes_id', $class->id)->count() }}
                    <?php $class_id = "class_id=".$class->id ;?>
                    <a class="btn btn-info" href="{{ route('classes.subjects', $class->id)}}">Zarządzaj przedmiotami</a></td>
                <td><?php
                    if(\App\Models\Educators::where('classes_id','=',$class->id)->exists()){
                    $educator = \App\Models\Teachers::where('id','=',\App\Models\Educators::where('classes_id','=',$class->id)->first()->teachers_id)->first();
                    echo $educator->name . " " . $educator->second_name . " " . $educator->last_name;
                    }
                    else{
                        ?>
                    <a class="btn btn-info" href="{{route('educators.create')}}"><i class="fas fa-plus"></i></a>
                        <?php
                    }

                    ?></td>
                <td>

                    <table>

                        <td>
                            <a class="btn btn-info" href="{{ route('classes.edit', $class->id)}}"><i class="fas fa-edit"></i></a>
                        </td>
                        <td>
                            {!! Form::open(['method' => 'DELETE', 'route' => ['classes.destroy', $class->id]]) !!}
                            <button class="btn btn-danger" onclick="return confirm('Potwierdź usunięcie klasy!')"><i class="far fa-trash-alt"></i></button>
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
