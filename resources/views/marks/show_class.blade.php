@extends('layout')


@section('page_info')
    {{ __('Klasa:') }}
    {{ __('Przemiot:') }}
@endsection


@section('content')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js" integrity="sha512-eyHL1atYNycXNXZMDndxrDhNAegH2BDWt1TmkXJPoGf1WLlNYt08CSjkqF5lnCRmdm3IrkHid8s2jOUY4NIZVQ==" crossorigin="anonymous"></script>

    <style>
        .parslay-errors-list li{
            list-style: none;
            color: red;
        }
    </style>
<?php $teacher_id = \App\Models\Teachers::where('users_id','=',Auth::user()->id)->first()->id;?>
    <div class="card-header">
        <p style="text-align: left">
            @if($teacher_id == $data['teachers_id'])
            <button class="btn btn-info" data-toggle="modal" data-target="#create_multiple_marks" >Dodaj oceny</button>
            @endif
            <span style="float: right">
            <a class="btn btn-info" href="{{route('marks.index')}}">Powrót</a>
        </span>
            <br><br>
        </p>

    </div>

    <table class="table table-hover">
        <tr>
            <th>UCZEŃ</th>
            <th>OCENY</th>
            <th>ŚREDNIA</th>
        </tr>

        @foreach($students_list as $student)
            <tr>
                <td>{{$student->name}} {{$student->second_name}} {{$student->last_name}}</td>
                <td>
                    <?php
                    $results = ['subjects_id' => $data['subjects_id'], 'students_id' => $student->id];
                    $marks = \App\Models\Marks::where($results)->get();
                    $url = $data['class_id'] . "|" . $student->id;
                    $sum_mark = 0;
                    $sum_mark_weight = 0;
                    $result_mark = 0;
                    ?>

                    @foreach($marks as $mark)
                        <?php
                        $sum_mark = $sum_mark + ($mark->mark * $mark->weight);
                        $sum_mark_weight = $sum_mark_weight + $mark->weight;
                        ?>
                            @if($teacher_id == $data['teachers_id'])
                        <span data-toggle="modal" data-target="#edit_mark" data-mark_id="{{$mark->id}}" data-mark_desc="{{$mark->mark_desc}}" data-description="{{$mark->description}}" data-weight="{{$mark->weight}}">
                            <button type="button" class="btn btn-outline-dark" data-toggle="tooltip" data-html="true" title="Waga: {{$mark->weight}}&#013Opis: {{$mark->description}}&#013Data: {{date('Y:m:d',strtotime($mark->updated_at))}}">
                                    {{$mark->mark_desc}}
                            </button>
                        </span>
                            @else
                                <button type="button" class="btn btn-outline-dark" data-toggle="tooltip" data-html="true" title="Waga: {{$mark->weight}}&#013Opis: {{$mark->description}}&#013Data: {{date('Y:m:d',strtotime($mark->updated_at))}}">
                                    {{$mark->mark_desc}}
                                </button>
                            @endif
                        @endforeach
                    <!-- Button create marks -->
                        @if($teacher_id == $data['teachers_id'])
                        <button class="btn btn-outline-secondary" data-toggle="modal" data-target="#create_mark" data-student_id="{{$student->id}}"><i class="far fa-plus-square fa-lg"></i></button>
                        @endif
                </td>
                <td>
                    <?php
                    if($sum_mark_weight != 0)
                    $result_mark = $sum_mark / $sum_mark_weight;
                    ?>

                        @if($result_mark > 0)
                            <button type="button" class="btn btn-outline-dark">
                                {{round($result_mark,2)}}
                            </button>
                        @endif
                </td>
            </tr>
        @endforeach
    </table>
    @if($teacher_id == $data['teachers_id'])

    <!-- Create marks -->
    <div class="modal fade" id="create_mark" tabindex="-1" role="dialog" aria-labelledby="create_mark_label" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="create_mark_label">Dodawanie oceny</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @include('classes.form_create')
                </div>
            </div>
        </div>
    </div>

    <!-- End create marks -->


    <!-- Edit marks -->
    <div class="modal fade" id="edit_mark" tabindex="-1" role="dialog" aria-labelledby="edit_mark_label" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="edit_mark_label">Edycja oceny</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @include('classes.form_edit')
                </div>
            </div>
        </div>
    </div>

    <!-- End edit marks -->

    <!-- Create marks -->
    <div class="modal fade" id="create_multiple_marks" tabindex="-1" role="dialog" aria-labelledby="create_multiple_marks_label" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="create_multiple_marks_label">Dodawanie ocen</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @include('classes.form_create_multiple_marks')
                </div>
            </div>
        </div>
    </div>

    <!-- End create marks -->

<script>
    $(function(){
        $("#mark_create").parsley();
    });


    @if (count($errors) > 0)
    $('#create_mark').modal('show');
    @endif



    $('#create_mark').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var student_id = button.data('student_id') // Extract info from data-* attributes
        console.log(student_id)
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
        modal.find('.modal-body #students_id').val(student_id);
    })

    $('#edit_mark').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var mark_id = button.data('mark_id') // Extract info from data-* attributes
        var mark_desc = button.data('mark_desc')
        var description = button.data('description')
        var weight = button.data('weight')
        console.log(mark_id)
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
        modal.find('.modal-body #marks_id').val(mark_id);
        modal.find('.modal-body #id').val(mark_id);
        modal.find('.modal-body #mark_desc').val(mark_desc);
        modal.find('.modal-body #description').val(description);
        modal.find('.modal-body #weight').val(weight);

    })

</script>
    @endif

@endsection


