@extends('layout')


@section('page_info')
    {{ __('Godziny lekcyjne') }}
@endsection


@section('content')
    <script src="{{asset('js/jquery.js')}}"></script>

    <div class="card-header">

        <p style="text-align: left">

            <span style="float: right">
            <a class="btn btn-info" href="{{route('dashboard')}}">Powrót</a>
        </span>
        </p><br><br>

    </div>

    <table class="table table-hover">
        <tr>
            <th>LEKCJA</th>
            <th>GODZINA ROZPOCZĘCIA</th>
            <th>GODZINA ZAKOŃCZENIA</th>
        </tr>
        {!! Form::model($id, ['route' => ['lesson_hours.update', $id], 'method' => 'PUT']) !!}

        @for($i=1;$i<=12;$i++)

            <tr>

                <td>
                    {{$i}}
                </td>
                <td>

                    <input type="time" id="start_time|{{$i}}" name="start_time|{{$i}}"
                           value="{{\App\Models\LessonHours::find($i)->start_time}}"
                           min="7:00" max="19:00" required>



                </td>
                <td>


                    <input type="time" id="end_time|{{$i}}" name="end_time|{{$i}}"
                           value="{{\App\Models\LessonHours::find($i)->end_time}}"
                           min="7:00" max="19:00" required>

                </td>

            </tr>
        @endfor
    </table>
    <div class="form-group">
        {!! Form::submit('Zapisz',['class'=>'btn btn-outline-primary']) !!}
        <a class="btn btn-outline-secondary" href="{{ route('lesson_hours.index') }}" role="button">Powrót</a>
    </div>

    {!! Form::close() !!}
@endsection




@if ($errors->any())
    <ul class="alert alert-danger">
        @foreach ($errors->all() as $error)
            <div class="btn btn-danger">{{ $error }}</div>
        @endforeach
    </ul>
@endif











