@extends('layout')


@section('page_info')
    {{ __('Lista Użytkowników') }}
@endsection


@section('content')


    <div class="card-header">
{{--        <p style="text-align: left"> <a class="btn btn-info" href="{{route('users.create')}}">Dodaj uwage</a>--}}
            <span style="float: right">
            <a class="btn btn-info" href="{{route('dashboard')}}">Powrót</a>
        </span>
        <br><br>
        </p>

    </div>

    <table class="table table-hover">
        <tr>
            <th colspan="4"><center>NOTATKI POZYTYWNE</center></th>
        </tr>
        @foreach($notes_positive as $note)
            <tr>


                <td>Od: {{\App\Models\Teachers::find($note->teachers_id)->name}} {{\App\Models\Teachers::find($note->teachers_id)->second_name}} {{\App\Models\Teachers::find($note->teachers_id)->last_name}}</td>
                <td>Treść: {{$note->content}}</td>
                <td>Data: {{$note->created_at}}</td>
                @if(\App\Models\Teachers::where('users_id', Auth::user()->id)->exists())
                    @if($note->teachers_id == \App\Models\Teachers::where('users_id', Auth::user()->id)->first()->id OR \App\Models\Students::find($note->students_id)->first()->classes_id == \App\Models\Educators::where('teachers_id', \App\Models\Teachers::where('users_id', Auth::user()->id)->first()->id)->first()->classes_id)
                        <td>
                            {!! Form::open(['method' => 'DELETE', 'route' => ['notes.destroy', $note->id]]) !!}
                            <button class="btn btn-danger" onclick="return confirm('Potwierdź usunięcie notatki!')"><i class="far fa-trash-alt"></i></button>
                            {!! Form::close() !!}

                        </td>
                    @endif
                @endif


            </tr>
        @endforeach

        <tr>
            <th colspan="4"><center>NOTATKI NEGATYWNE</center></th>
        </tr>
        @foreach($notes_negative as $note)
            <tr>

                <td>Od: {{\App\Models\Teachers::find($note->teachers_id)->name}} {{\App\Models\Teachers::find($note->teachers_id)->second_name}} {{\App\Models\Teachers::find($note->teachers_id)->last_name}}</td>
                <td>Treść: {{$note->content}}</td>
                <td>Data: {{$note->created_at}}</td>
                @if(\App\Models\Teachers::where('users_id', Auth::user()->id)->exists())
                    @if($note->teachers_id == \App\Models\Teachers::where('users_id', Auth::user()->id)->first()->id OR \App\Models\Students::find($note->students_id)->first()->classes_id == \App\Models\Educators::where('teachers_id', \App\Models\Teachers::where('users_id', Auth::user()->id)->first()->id)->first()->classes_id)
                        <td>
                            {!! Form::open(['method' => 'DELETE', 'route' => ['notes.destroy', $note->id]]) !!}
                            <button class="btn btn-danger" onclick="return confirm('Potwierdź usunięcie notatki!')"><i class="far fa-trash-alt"></i></button>
                            {!! Form::close() !!}

                        </td>
                    @endif
                @endif

            </tr>
        @endforeach
    </table>


@endsection


