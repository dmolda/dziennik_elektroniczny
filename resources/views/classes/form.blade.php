{!! Form::open(['route' => 'marks.store']) !!}
{{ csrf_field() }}

@if ($errors->any())
    <ul class="alert alert-danger">

        @foreach($errors->all() as $error)
            <li> {{$error}}</li>
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

        Ocena : <select class="form-control" id='ocena' name='ocena'>
            <option value='0'>-- Wybierz Ocene --</option>
            <option value='1'>1</option>
            <option value='1.5'>1.5</option>
            <option value='2'>2</option>
            <option value='2.5'>2.5</option>
            <option value='3'>3</option>
            <option value='3.5'>3.5</option>
            <option value='4'>4</option>
            <option value='4.5'>4.5</option>
            <option value='5'>5</option>
            <option value='5.5'>5.5</option>
            <option value='6'>6</option>
        </select>
    </div>

    <div class="col-md-12">
        {!! Form::label('opis', "Opis") !!} <br>
        {!! Form::text('opis', null, ['class' => 'form-control']) !!}
    </div>

    <div class="col-md-12">

        Waga : <select class="form-control" id='waga' name='waga'>
            <option value='0'>-- Wybierz Ocene --</option>
            <option value='1'>1</option>
            <option value='2'>2</option>
            <option value='3'>3</option>
            <option value='4'>4</option>
            <option value='5'>5</option>
            <option value='6'>6</option>
        </select>
    </div>




</div>


