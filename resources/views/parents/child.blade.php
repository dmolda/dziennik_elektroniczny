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
            <th>DZIECKO</th>
            <th>KLASA</th>
            <th>OPCJE</th>
        </tr>
        @foreach($children_list as $child)
            <tr>
                <td>{{\App\Models\Students::find($child->students_id)->name}} {{\App\Models\Students::find($child->students_id)->second_name}} {{\App\Models\Students::find($child->students_id)->last_name}}</td>
                <td>{{\App\Models\Classes::find(\App\Models\Students::find($child->students_id)->classes_id)->name}}</td>
                <td><a class="btn btn-outline-primary" href="{{route('schedules.show', \App\Models\Students::where('id','=',$child->students_id)->first()->classes_id)}}" role="button">Plan lekcji</a>
                    <a class="btn btn-outline-primary" href="{{route('marks.show',$child->students_id)}}" role="button">Pokaż oceny</a></td>
            </tr>
        @endforeach
    </table>



@endsection


