@extends('layout')

@section('page_info')
    {{ __('Nowa wiadomość') }}
@endsection

@section('content')
    <script src="{{asset('js/jquery.js')}}"></script>
    <div class="card-header">
        <p style="text-align: left">
        <div class="form-group">
            @if(empty($_GET['message_id']))

                {!! Form::label('search', "Wyszukaj:") !!}
                {!! Form::text('search', null, ['class'=>'form-control']) !!}
                <input type="hidden" class="form-group" id="users" name="users" value="yes">
            @endif

        </div>
        <span style="float: right">
        </span>
        <br><br>
        </p>
    </div>

    {!! Form::open(['route' => 'messages.store']) !!}

    @if ($errors->any())
        <ul class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <div class="btn btn-danger">{{ $error }}</div>
            @endforeach
        </ul>
    @endif


    <div class="form-group">

        @if(!empty($_GET['message_id']) && Auth::user()->id == \App\Models\Messages::find($_GET['message_id'])->recipient)
            <?php $user_id = \App\Models\Messages::find($_GET['message_id'])->sender;
            $message_subject = "RE:" . \App\Models\Messages::find($_GET['message_id'])->message_subject;
            ?>
        <input type="hidden" name="recipient" id="recipient" value="{{$user_id}}">
                {!! Form::label('recipient', "Odbiorca:") !!} <b>
                    @if(\App\Models\RolesHasUsers::where(['users_id' => $user_id,'roles_id' => '4'])->first())
                        {{\App\Models\Teachers::where('users_id', $user_id)->first()->name}} {{\App\Models\Teachers::where('users_id', $user_id)->first()->last_name}}

                    @elseif(\App\Models\RolesHasUsers::where(['users_id' => $user_id,'roles_id' => '5'])->first())
                        {{\App\Models\Parents::where('users_id', $user_id)->first()->name}} {{\App\Models\Parents::where('users_id', $user_id)->first()->last_name}}


                    @elseif(\App\Models\RolesHasUsers::where(['users_id' => $user_id,'roles_id' => '6'])->first())
                        {{\App\Models\Students::where('users_id', $user_id)->first()->name}} {{\App\Models\Students::where('users_id', $user_id)->first()->last_name}}

                    @elseif(\App\Models\RolesHasUsers::where(['users_id' => $user_id,'roles_id' => '1'])->first())
                        Administracja

                    @endif
                </b> <br>


                    <div class="form-group">
                {!! Form::label('message_subject', "Temat:") !!}
                {!! Form::text('message_subject', $message_subject, ['class'=>'form-control']) !!}
                    </div>
        @else
            <div class="form-group">
                <table class="table table-bordered table-hover">
                    <tbody>
                    </tbody>
                </table>
                </div>

                <div class="form-group">
            {!! Form::label('message_subject', "Temat:") !!}
            {!! Form::text('message_subject', null, ['class'=>'form-control']) !!}
                </div>


        @endif

                <div class="form-group">
            {!! Form::label('message', "Treść:") !!}
            {!! Form::text('message', null,['class'=>'form-control']) !!}
                </div>

            <div class="form-group">
        {!! Form::submit('Zapisz',['class'=>'btn btn-outline-primary']) !!}
        {!! link_to(URL::previous(),'Powrót',['class'=> 'btn btn-outline-secondary']) !!}
    </div>
    </div>

    {!! Form::close() !!}


    <script type="text/javascript">
        $('#search').on('keyup',function(){
            $value=$(this).val();
            $users=$('#users').val();
            $.ajax({
                type : 'get',
                url : '{{URL::to('search')}}',
                data:{'search':$value,'users':$users},
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
