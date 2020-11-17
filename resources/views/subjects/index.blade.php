@extends('layout')

@section('page_info')
    {{ __('Lista przedmiotów') }}
@endsection

@section('content')

    @if(session()->has('message'))
        <script>
            swal("Przedmiot został dodany!", "", "success");
        </script>
    @endif

    <div class="card-header">
        <p style="text-align: left">
            <a class="btn btn-info" href="{{route('subjects.create')}}">Dodaj nowy przedmiot</a>
                        <span style="float: right">
            <a class="btn btn-info" href="{{route('dashboard')}}">Powrót</a>
                    </span>
        </p>
    </div>

    <table class="table table-hover">
        <tr>
            <th>NAZWA</th>
            <th>OPIS</th>
            <th>EDYTUJ</th>
            <th>USUŃ</th>
        </tr>

        @foreach($subjects_list as $subject)
            <tr>
                <td>{{$subject->name}} </td>
                <td>{{$subject->description}}</td>
                <td>
                    <a class="btn btn-info" href="{{ route('subjects.edit', $subject->id)}}"><i class="fas fa-user-edit"></i></a>
                </td>
                <td>
                    {!! Form::open(['method' => 'DELETE', 'route' => ['subjects.destroy', $subject->id]]) !!}
                    <button class="btn btn-danger"><i class="fas fa-trash"></i></button>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach




    </table>

    {{ $subjects_list->links() }}





@endsection
