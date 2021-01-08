@extends('layout')


@section('page_info')
    {{ __('Wiadomości') }}
@endsection


@section('content')


    <div class="card-header">
        <p style="text-align: left"> <a class="btn btn-info" href="{{route('messages.create')}}">Nowa wiadomość</a> <a class="btn btn-info" href="{{route('messages.create_mass_message')}}">Wyślij wiadomość do całej klasy</a>
            <span style="float: right">
                            <a class="btn btn-info" href="{{route('messages.messages_sent', Auth::user()->id)}}">Pokaż wysłane wiadomości</a>
            <a class="btn btn-info" href="{{route('dashboard')}}">Powrót</a>
        </span>
        </p>

    </div>

    <table class="table table-hover">
        <tr>
            <th>OD</th>
            <th>TEMAT</th>
            <th>DATA</th>
            <th>OPCJE</th>
        </tr>
        @foreach($messages_list as $message)
            @if($message->status != "deleted")
            <tr>

                <td>{{ \App\Models\Users::find($message->sender)->name }}</td>

                <td>@if($message->status == 'new')
                    <b>{{$message->message_subject }}</b>
                        @else
                        <p style="color:grey">{{$message->message_subject }}</p>
                    @endif
                </td>
                <td>{{$message->created_at}}</td>
                <td><table><td>
                    <a class="btn btn-outline-primary" href="{{route('messages.show', $message->id)}}" role="button"><i class="fa fa-eye" aria-hidden="true"></i></a></td>
                        <td>
                    {!! Form::open(['method' => 'DELETE', 'route' => ['messages.destroy', $message->id]]) !!}
                    <button class="btn btn-danger" onclick="return confirm('Potwierdź usunięcie wiadomości!')"><i class="far fa-trash-alt"></i></button>
                    {!! Form::close() !!}</td>
                    </table>
                </td>

            </tr>
            @endif
        @endforeach
    </table>
    {{ $messages_list->links() }}


@endsection


