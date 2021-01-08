@extends('layout')

@section('page_info')
    {{ __('Nowa wiadomość') }}
@endsection

@section('content')

    <script src="{{asset('js/jquery.js')}}"></script>

    <div class="card-header">
        <p style="text-align: left">
        <div class="form-group">

            {!! Form::label('search', "Wyszukaj:") !!}
            {!! Form::text('search', null, ['class'=>'form-control']) !!}
            <input type="hidden" class="form-group" id="class" name="class" value="yes">
        </div>
        <span style="float: right">
            <a class="btn btn-info" href="{{route('messages.index')}}">Powrót</a>
        </span>
        <br><br>
        </p>
    </div>



    {!! Form::open(['route' => 'messages.multiple_store']) !!}

    @if ($errors->any())
        <ul class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <div class="btn btn-danger">{{ $error }}</div>
            @endforeach
        </ul>
    @endif



    <div class="form-group">


            <div class="form-group">
                {!! Form::label('classes', "Klasa:") !!}
                <table class="table table-bordered table-hover">
                    <tbody>

                    </tbody>
                </table>
            </div>

            <div class="form-group">
                {!! Form::label('message_subject', "Temat:") !!}
                {!! Form::text('message_subject', null, ['class'=>'form-control']) !!}
            </div>

        <div class="form-group">
            {!! Form::label('message', "Treść:") !!}
            {!! Form::text('message', null,['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('parents_message', "Czy rodzice mają otrzymać wiadomość?") !!}
            {!! Form::checkbox('parents_message', 'yes'); !!}
        </div>

        <div class="form-group">
            {!! Form::label('parents_message', "Tylko rodzice:") !!}
            {!! Form::checkbox('parents_only_message', 'yes'); !!}
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
            $class=$('#class').val();
            $.ajax({
                type : 'get',
                url : '{{URL::to('search')}}',
                data:{'search':$value,'class':$class},
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
