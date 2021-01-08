@extends('layout')

@section('page_info')
    {{ __('Lista uczniów') }}
@endsection

@section('content')
    <script src="{{asset('js/jquery.js')}}"></script>

    <div class="card-header">
        <p style="text-align: left">
        <div class="form-group">
             <input type="hidden" class="form-group" id="parent_id" name="parent_id" value="{{$_GET['parents_id']}}">

            {!! Form::label('search', "Wyszukaj:") !!}
            {!! Form::text('search', null, ['class'=>'form-control']) !!}
        </div>
            <span style="float: right">
            <a class="btn btn-info" href="{{route('users.index')}}">Powrót</a>
        </span>
            <br><br>
        </p>
    </div>



        <table class="table table-bordered table-hover">
            <thead>
            <tr>
                <th>IMIE(IMIONA)</th>
                <th>NAZWISKO</th>
                <th>KLASA</th>
                <th>NAZWA UŻYTKOWNIKA</th>
                <th>OPCJE</th>
            </tr>

            </thead>
            <tbody>
            </tbody>
        </table>
        </div>

        <script type="text/javascript">
            $('#search').on('keyup',function(){
                $value=$(this).val();
                $parent_id=$('#parent_id').val();
                $.ajax({
                    type : 'get',
                    url : '{{URL::to('/parents/search')}}',
                    data:{'search':$value,'parent_id':$parent_id},
                    success:function(data){
                        $('tbody').html(data);
                    }
                });
            })
        </script>
        <script type="text/javascript">
            $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
        </script>





    </table>




@endsection
