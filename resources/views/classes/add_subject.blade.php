@extends('layout')

@section('page_info')
    Dodawanie przedmiotu do klasy: {{$class->name}}
@endsection

@section('content')
    <script src="{{asset('js/jquery.js')}}"></script>
    <script src="{{asset('js/app.js')}}"></script>
    <div class="card-header">
        <p style="text-align: right">
            <span style="float: right">
            <a class="btn btn-info" href="{{route('classes.subjects', $id)}}">Powrót</a>
        </span>
            <br>
        </p>
    </div>

    {!! Form::open(['route' => 'classes.store_add_subject']) !!}
    <div class="form-group">
        <?php
        $class_id = \App\Models\Classes::where('id','=', $id)->first()->id;
        ?>
        <input type="hidden" name="classes_id" value="{!! $class_id !!}">
        {!! Form::label('subjects_id', "Wybierz przedmiot:") !!}
        <select class="form-control" id="subjects_id" name="subjects_id">
            <option value="" disabled selected>Wybierz opcję</option>
            <?php
            $subjects_name = DB::select(DB::raw("SELECT DISTINCT(`subjects`.`name`),`subjects`.`id` FROM `subjects` WHERE NOT `subjects`.`id` = ANY (SELECT `subjects`.`id` FROM((`subjects`
                                                                                                    INNER JOIN `classes_has_subjects` ON `subjects`.`id` = `classes_has_subjects`.`subjects_id`)
                                                                                                     INNER JOIN `classes` ON `classes_has_subjects`.`classes_id` = `classes`.`id`) WHERE  `classes_has_subjects`.`classes_id` = $class->id);"));
            foreach ($subjects_name as $subject_name){
                echo "<option value='$subject_name->id'>" . $subject_name->name . "</option>";
            }
            ?>


        </select>

        Nauczyciel: <select class="form-control" id="teachers_id" name="teachers_id">
            <option value="" >Wybierz Nauczyciela</option>

            <script type='text/javascript'>

                $(document).ready(function(){

                    // Department Change
                    $('#subjects_id').change(function(){

                        // Department id
                        var id = $(this).val();

                        // Empty the dropdown
                        $('#teachers_id').find('option').not(':first').remove();

                        // AJAX request
                        $.ajax({
                            url: '/classes/getTeacher/'+id,
                            dataType: 'json',
                            type: 'get',
                            success: function(response){

                                var len = 0;
                                if(response['data'] != null){
                                    len = response['data'].length;
                                }

                                if(len > 0){
                                    // Read data and create <option >
                                    for(var i=0; i<len; i++){

                                        var id = response['data'][i].id;
                                        var name = response['data'][i].name + " " +response['data'][i].second_name + " " +response['data'][i].last_name;

                                        var option = "<option value='"+id+"'>"+name+"</option>";

                                        $("#teachers_id").append(option);
                                    }
                                }

                            }
                        });
                    });

                });

            </script>

        {!! Form::submit('Zapisz',['class'=>'btn btn-outline-primary']) !!}



    </div>

    {!! Form::close() !!}





@endsection
