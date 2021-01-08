@extends('layout')


@section('page_info')
    {{ __('Lista Klas') }}
@endsection


@section('content')


    <div class="card-header">
        <p style="text-align: left">
            <a class="btn btn-info" href="{{route('parents.create', 'parents_id='.$parent_id)}}">Dodaj dziecko</a>
            <span style="float: right">
            <a class="btn btn-info" href="{{route('dashboard')}}">Powrót</a>
        </span>
            <br><br>
        </p>

    </div>

    <table class="table table-hover">
        <tr>
            <th>DZIECKO</th>
            <th>KLASA</th>
            <th>OPCJE</th>
        </tr>
        @foreach($children_list as $child)
            <tr>
                <td>{{\App\Models\Students::find($child->students_id)->name}} {{\App\Models\Students::find($child->students_id)->second_name}} {{\App\Models\Students::find($child->students_id)->last_name}}</td>
                <td>{{\App\Models\Classes::find(\App\Models\Students::find($child->students_id)->classes_id)->name}}</td>
                <td>{!! Form::open(['method' => 'DELETE', 'route' => ['parents_has_students.destroy', $child->id]]) !!}
                    <button class="btn btn-danger" onclick="return confirm('Potwierdź usunięcie dziecka!')">USUŃ</button>
                    {!! Form::close() !!}</td>
            </tr>
        @endforeach
    </table>



@endsection


