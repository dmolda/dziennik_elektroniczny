@extends('layout')

@section('page_info')
    {{ __('Lista uczniów') }}
@endsection

@section('content')
    <script src="{{asset('js/jquery.js')}}"></script>
    <div class="card-header">
        <p style="text-align: left">
            {!! Form::label('search', "Wyszukaj:") !!}
            {!! Form::text('search', null, ['class'=>'form-control']) !!} <br>
            <span style="float: right">
            <a class="btn btn-info" href="{{route('users.index')}}">Powrót</a>
        </span>
        </p>
        <br><br>
    </div>

    <table class="table table-hover">
        <tr>
            <th>IMIE(IMIONA)</th>
            <th>NAZWISKO</th>
            <th>KLASA</th>
            <th>NAZWA UŻYTKOWNIKA</th>
            <th>OPCJE</th>
        </tr>
        <tbody></tbody>

        @foreach($student_list as $student)
            <tr>
                <td>{{ $student->name }} {{ $student->second_name }}</td>
                <td>{{$student->last_name}}</td>
                <td>{{\App\Models\Classes::find($student->classes_id)->name}}</td>
                <td>@if((\App\Models\Users::where('id' , $student->users_id)->exists()))

                    {{\App\Models\Users::find($student->users_id)->name}}
                    @else
                        UŻYTKOWNIK USUNIĘTY
                    @endif

                </td>
                <td><table><td>
                    <a class="btn btn-info" href="{{route('students.show', $student->id)}}"><i class="fas fa-user-edit"></i></a>
                        </td>
                        <td>
                    {!! Form::open(['method' => 'DELETE', 'route' => ['students.destroy', $student->id]]) !!}
                    <button class="btn btn-danger" onclick="return confirm('Potwierdź usunięcie ucznia!')"><i class="far fa-trash-alt"></i></button>
                    {!! Form::close() !!}
                        </td>
                    </table>
                </td>
            </tr>
        @endforeach




    </table>

    {{ $student_list->links() }}

    <script type="text/javascript">
        $('#search').on('keyup',function(){
            $value=$(this).val();
            $.ajax({
                type : 'get',
                url : '{{URL::to('students_search')}}',
                data:{'search':$value},
                success:function(data){
                    $('tbody').html(data);
                }
            });
        })
    </script>
    <script type="text/javascript">
        $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
    </script>

@endsection
