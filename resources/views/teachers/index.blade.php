@extends('layout')

@section('page_info')
    {{ __('Lista nauczycieli') }}
@endsection

@section('content')
    <script src="{{asset('js/jquery.js')}}"></script>
    <div class="card-header">

        <p style="text-align: left">
            {!! Form::label('search', "Wyszukaj:") !!}
            {!! Form::text('search', null, ['class'=>'form-control']) !!} <br>


            <span style="float: right">
            <a class="btn btn-info" href="{{route('dashboard')}}">Powrót</a>
        </span>
        </p><br><br>

    </div>



    <table class="table table-hover">
        <tr>
            <th>IMIE(IMIONA)</th>
            <th>NAZWISKO</th>
            <th>PRZEDMIOT</th>
            <th>NAZWA UŻYTKOWNIKA</th>
            <th>EDYTUJ</th>
            <th>USUŃ</th>
        </tr>
        <tbody></tbody>

        @foreach($teacher_list as $teacher)
            <tr>
                <td>{{ $teacher->name }} {{ $teacher->second_name }}</td>
                <td>{{$teacher->last_name}}</td>
                <td>
                    <?php
                    $subjects_list = \App\Models\TeachersHasSubject::where('teachers_id', $teacher->id)->get();
                    ?>
                    @foreach($subjects_list as $subject)
                        {{ \App\Models\Subjects::find($subject->subjects_id)->name }}
                        <br>
                        @endforeach


                    <br>
                        <a class="btn btn-info" href="{{route('teachers.manage_subjects', $teacher->id)}}">Zarządzaj przedmiotami</a>
                </td>
                <td>{{\App\Models\Users::find($teacher->users_id)->name}}</td>
                <td>
                    <a class="btn btn-info" href="{{route('teachers.show', $teacher->id)}}"><i class="fas fa-user-edit"></i></a>
                </td>
                <td>
                    {!! Form::open(['method' => 'DELETE', 'route' => ['teachers.destroy', $teacher->id]]) !!}
                    <button class="btn btn-danger" onclick="return confirm('Potwierdź usunięcie nauczyciela!')"><i class="fas fa-trash"></i></button>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach




    </table>

    {{ $teacher_list->links() }}

    <script type="text/javascript">
        $('#search').on('keyup',function(){
            $value=$(this).val();
            $.ajax({
                type : 'get',
                url : '{{URL::to('search_teacher')}}',
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
