{!! Form::open(['route' => 'marks.multiple_store']) !!}

{{--<form name="product-add" id="product-add" method="post" action="{{url('marks/store-product')}}">--}}
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
    </div> <br>

    <div class="col-md-12">

        <table class="table table-bordered table-hover">
            <tr>
                <th>UCZEN</th>
                <th>OCENA</th>
            </tr>
            <?php $i=1; ?>
            @foreach($students_list as $student)

                <tr>

                    <td>
                    {{$student->name}} {{$student->second_name}} {{$student->last_name}}
                    </td>

                    <td>
                    <input class="form-control" name="{{$i}}" id="{{$i}}" type="text">
                        <input type="hidden" name="student{{$i}}" id="student{{$i}}" value="{{$student->id}}">

                    </td>
                </tr>
                <?php $i++; ?>
            @endforeach
        </table>
    </div>











</div>


</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Zamknij</button>
    <button style="cursor:pointer" type="submit" class="btn btn-primary">Zapisz</button>

{!! Form::close() !!}
