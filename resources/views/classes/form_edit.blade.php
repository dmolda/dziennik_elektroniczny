{{--{!! Form::open(['route' => 'marks.update','update']) !!}--}}
<form action="{{route('marks.update','update')}}" method="post">
{{method_field('patch')}}
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
        <input type="hidden" name="id" id="id">
    </div>




    <div class="col-md-12">
        <label for="mark_desc"><a data-toggle="tooltip" title="Przykład: +3">Ocena</a> </label>

        <input class="form-control" name="mark_desc" type="text" id="mark_desc" required />
    </div>


    <div class="col-md-12">
        <label for="description">Opis</label>
        <input class="form-control" name="description" type="text" id="description" required data-parsley-minlength="2">
    </div>

    <div class="col-md-12">
        {!! Form::label('weight', "Waga") !!} <br>
            <select class="form-control" id='weight' name='weight' required>
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
        <button style="cursor:pointer" type="submit" class="btn btn-primary" name="submit" value="save">Zapisz</button>
        <button style="cursor:pointer" type="submit" class="btn btn-danger" name="submit" value="delete" onclick="return confirm('Potwierdź usunięcie oceny!')">Usuń</button>

{!! Form::close() !!}

