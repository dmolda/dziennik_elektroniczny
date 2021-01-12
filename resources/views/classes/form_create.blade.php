{!! Form::open(['route' => 'marks.store']) !!}

{{--<form name="product-add" id="product-add" method="post" action="{{url('marks/store-product')}}">--}}
    {{ csrf_field() }}
@if ($errors->any())
    <ul class="alert alert-danger">

        @foreach($errors->all() as $error)
            <li> {{$error}}</li>
            {{header("Refresh:2")}}
        @endforeach
    </ul>
@endif


<div class="form-group">
    <div class="col-md-12">
        <input type="hidden" name="classes_has_subjects_id" id="classes_has_subjects_id" value="{{$data['classes_has_subjects_id']}}">
        <input type="hidden" name="teachers_id" id="teachers_id" value="{{$data['teachers_id']}}">
        <input type="hidden" name="classes_id" id="classes_id" value="{{$data['class_id']}}">
        <input type="hidden" name="subjects_id" id="subjects_id" value="{{$data['subjects_id']}}">
        <input type="hidden" name="students_id" id="students_id" >
    </div>




        <div class="col-md-12">
            {!! Form::label('mark_desc', " ") !!}<a data-toggle="tooltip" title="Przykład: +3">Ocena</a> <br>
            <input type="text" id="mark_desc" name="mark_desc" class="form-control" required data-parsley-pattern="[a-zA-Z ]+$"/>


        </div>



    <div class="col-md-12">
        {!! Form::label('description', "Opis") !!} <br>
        <input type="text" id="description" name="description" class="form-control" required data-parsley-min="2"/>

    </div>


    <div class="col-md-12">
        {!! Form::label('weight', "Waga") !!} <br>
        <select id='weight' name='weight' class="form-control" required>
        <option disabled selected value="">-- Wybierz wage --</option>
        <option value='1'>1</option>
        <option value='2'>2</option>
        <option value='3'>3</option>
        <option value='4'>4</option>
        <option value='5'>5</option>
        <option value='6'>6</option>
        </select>
    </div>

</div>


</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Zamknij</button>
    <button style="cursor:pointer" type="submit" class="btn btn-primary">Zapisz</button>

{!! Form::close() !!}
