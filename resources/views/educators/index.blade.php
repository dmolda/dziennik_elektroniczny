@extends('layout')

@section('page_info')
    {{ __('Lista wychowawców') }}
@endsection

@section('content')

    <div class="card-header">
        <p style="text-align: left">
            <a class="btn btn-info" href="{{route('educators.create')}}">Dodaj nowego wychowawcę</a>
                        <span style="float: right">
            <a class="btn btn-info" href="{{route('dashboard')}}">Powrót</a>
                    </span>
        </p>
    </div>

    <table class="table table-hover">
        <tr>
            <th>IMIE(IMIONA)</th>
            <th>NAZWISKO</th>
            <th>KLASA</th>
            <th>NAZWA UŻYTKOWNIKA</th>
            <th>USUŃ</th>
        </tr>

        @foreach($educators_list as $educator)
            <?php $teacher_data = \App\Models\Teachers::where('id',$educator->teachers_id)->get() ;?>
        @foreach($teacher_data as $teacher)
            <tr>
                <td>{{ $teacher->name }} {{ $teacher->second_name }}</td>
                <td>{{$teacher->last_name}}</td>
                <td>{{\App\Models\Classes::find($educator->classes_id)->name}}</td>
                <td>{{\App\Models\Users::find($teacher->users_id)->name}}</td>
                <td>
                    {!! Form::open(['method' => 'DELETE', 'route' => ['educators.destroy', $educator->id]]) !!}
                    <button class="btn btn-danger"><i class="fas fa-trash"></i></button>
                    {!! Form::close() !!}
                </td>
            </tr>
            @endforeach
        @endforeach




    </table>

    {{ $educators_list->links() }}



@endsection
