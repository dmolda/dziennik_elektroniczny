@extends('layout')


@section('page_info')
    {{ __('Wiadomości') }}
@endsection


@section('content')


    <div class="card-header">
        <p style="text-align: left">
            <span style="float: right">
            <a class="btn btn-info" href="{{route('dashboard')}}">Powrót</a>
        </span>
        </p><br><br>

    </div>

    <table class="table table-hover">
        <tr>
            <th>DO</th>
            <th>TEMAT</th>
            <th>DATA</th>
            @if(Auth()->user()->hasAnyRole(['Administrator']))
            <th>DATA OTWARCIA/USUNIĘCIA</th>
            @endif
            <th>OPCJE</th>
        </tr>
        @foreach($messages as $message)
            <tr>

                <td>{{ \App\Models\Users::find($message->recipient)->name }}</td>

                <td>@if($message->status == 'new')
                        <b>{{$message->message_subject }}</b>
                    @elseif($message->status == 'deleted' AND Auth()->user()->hasAnyRole(['Administrator']))
                        <p style="color:red">{{$message->message_subject }}</p>
                    @else
                        <p style="color:grey">{{$message->message_subject }}</p>
                    @endif
                </td>
                <td>{{$message->created_at}}</td>
                @if(Auth()->user()->hasAnyRole(['Administrator']))
                    <td>{{$message->updated_at}}</td>
                @endif

                <td><table><td>
                            <a class="btn btn-outline-primary" href="{{route('messages.show', $message->id)}}" role="button"><i class="fa fa-eye" aria-hidden="true"></i></a></td>
                        <td>
                            {!! Form::open(['method' => 'DELETE', 'route' => ['messages.destroy', $message->id]]) !!}
                            <button class="btn btn-danger" onclick="return confirm('Potwierdź usunięcie wiadomości!')"><i class="far fa-trash-alt"></i></button>
                            {!! Form::close() !!}</td>
                    </table>
                </td>

            </tr>
        @endforeach
    </table>
    {{ $messages->links() }}


@endsection


