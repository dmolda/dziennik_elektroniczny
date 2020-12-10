@extends('layout')

@section('page_info')
    Lista przedmiotów klasy: {{$class->name}}
@endsection

@section('content')

    <div class="card-header">
        <p style="text-align: left"> <a class="btn btn-info" href="{{route('classes.subject.create', $class->id)}}">Dodaj nowy przedmiot</a>
            <span style="float: right">
            <a class="btn btn-info" href="{{route('users.index')}}">Powrót</a>
        </span>
        </p>
    </div>

    <table class="table table-hover">
        <tr>
            <th>PRZEDMIOT</th>
            <th>NAUCZYCIEL</th>
            <th>USUŃ</th>
        </tr>
        @foreach($subjects_list as $subject)
            <tr>
            <td>{{\App\Models\Subjects::where('id','=',$subject->subjects_id)->first()->name}}</td>
            <td><?php $teacher = \App\Models\Teachers::where('id','=',$subject->teachers_id)->first(); ?>
            {{$teacher->name}}
                {{$teacher->second_name}}
                {{$teacher->last_name}}
            </td>
            <td>
                {!! Form::open(['method' => 'DELETE', 'route' => ['classeshassubjects.destroy', $subject->id]]) !!}
                <button class="btn btn-danger"><i class="far fa-trash-alt"></i></button>
                {!! Form::close() !!}</td>
            </tr>
            @endforeach











    </table>



@endsection
