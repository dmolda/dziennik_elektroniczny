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
        </span>
        </p>
    </div>

    {!! Form::open(['route' => 'notes.store']) !!}

    @if ($errors->any())
        <ul class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <div class="btn btn-danger">{{ $error }}</div>
            @endforeach
        </ul>
    @endif
    <div class="form-group">
        <table class="table table-bordered table-hover">
            <tbody>
            </tbody>
        </table>
    </div>
    <input type="hidden" class="form-group" id="teachers_id" name="teachers_id" value="{{\App\Models\Teachers::where('users_id',Auth::user()->id)->first()->id}}">

    <div class="form-group">
        {!! Form::label('type', "Rodzaj notatki:") !!}
        {!!     Form::select('type', ['positive' => 'Pozytywna', 'negative' => 'Negatywna'], null, ['placeholder' => 'Wybierz rodzaj...']); !!}
    </div>


        <div class="form-group">
            {!! Form::label('content', "Treść:") !!}
            {!! Form::text('content', null,['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::submit('Zapisz',['class'=>'btn btn-outline-primary']) !!}
            {!! link_to(URL::previous(),'Powrót',['class'=> 'btn btn-outline-secondary']) !!}
        </div>

    {!! Form::close() !!}


    <script type="text/javascript">
        $('#search').on('keyup',function(){
            $value=$(this).val();
            $.ajax({
                type : 'get',
                url : '{{URL::to('search_students')}}',
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
