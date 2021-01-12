@extends('layout')


@section('page_info')
    {{ __('Wiadomości') }}
@endsection


@section('content')


    <div class="card-header">
        @if($message->recipient == Auth::user()->id)
        <p style="text-align: left">
            <a class="btn btn-info" href="{{route('messages.create', 'message_id='.$message->id)}}">Odpowiedz</a>
            <span style="float: right">
            <a class="btn btn-info" href="{{route('messages.index')}}">Powrót</a>
        </span>
        </p>

        @else
            <p style="text-align: right">
                <a class="btn btn-info" href="{{route('messages.show_user_message',$message->recipient)}}">Powrót</a></p>
        @endif

    </div>

    <table class="table table-hover">
        <tr>
            <th>OD:

                @if(\App\Models\RolesHasUsers::where(['users_id' => $message->sender,'roles_id' => '4'])->first())
                    {{\App\Models\Teachers::where('users_id', $message->sender)->first()->name}} {{\App\Models\Teachers::where('users_id', $message->sender)->first()->last_name}}

                @elseif(\App\Models\RolesHasUsers::where(['users_id' => $message->sender,'roles_id' => '5'])->first())
                    {{\App\Models\Parents::where('users_id', $message->sender)->first()->name}} {{\App\Models\Parents::where('users_id', $message->sender)->first()->last_name}}


                @elseif(\App\Models\RolesHasUsers::where(['users_id' => $message->sender,'roles_id' => '6'])->first())
                    {{\App\Models\Students::where('users_id', $message->sender)->first()->name}} {{\App\Models\Students::where('users_id', $message->sender)->first()->last_name}}

                @elseif(\App\Models\RolesHasUsers::where(['users_id' => $message->sender,'roles_id' => '1'])->first())
                    Administracja

                @endif

            </th>
            <th>TEMAT: {{ $message->message_subject }}</th>

        </tr>
        <tr>
                <td colspan="2">{{$message->message}}</td>


            </tr>
    </table>


@endsection


