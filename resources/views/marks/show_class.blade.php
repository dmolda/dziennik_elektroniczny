@extends('layout')


@section('page_info')
    {{ __('Klasa:') }}
    {{ __('Przemiot:') }}
@endsection


@section('content')
{{--    <script type='text/javascript'>--}}


{{--        $(document).ready(function (){--}}
{{--            $('#btnShowModal').click(function(){--}}
{{--                var student_id = document.getElementById("btnShowModal").value;--}}
{{--                console.log(student_id);--}}
{{--                document.getElementById('students_id').value = student_id;--}}
{{--                return false;--}}
{{--            });--}}

{{--        });--}}

{{--    </script>--}}


    <div class="card-header">
        <p style="text-align: right">
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
                    ?>

                    @foreach($marks as $mark)

                            <a  href="{{ route('marks.edit',$mark->id) }}">
                                <button type="button" class="btn btn-outline-dark" data-toggle="tooltip" data-html="true" title="Waga: {{$mark->waga}}   Opis: {{$mark->opis}}" href="{{ route('marks.show_class', $mark->id) }}">
                                    {{$mark->mark_desc}}
                                </button></a>
                        @endforeach
                    <!-- Button create marks -->
                        <button class="btn btn-outline-secondary" data-toggle="modal" data-target="#edit" data-student_id="{{$student->id}}"><i class="far fa-plus-square fa-lg"></i></button>

                </td>
                <td>Tu bedzie średnia</td>



            </tr>
        @endforeach
    </table>




    <!-- Create marks -->
    <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @include('classes.form')


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Zamknij</button>
                        <button style="cursor:pointer" type="submit" class="btn btn-primary">Zapisz</button>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

    <!-- End create marks -->
<script>


    $('#edit').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var student_id = button.data('student_id') // Extract info from data-* attributes
        console.log(student_id)
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
        modal.find('.modal-body #students_id').val(student_id);
    })

</script>


@endsection


