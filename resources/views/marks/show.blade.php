@extends('layout')


@section('page_info')
    {{ __('Lista Użytkowników') }}
@endsection


@section('content')


    <div class="card-header">
        <p style="text-align: right">
            <span style="float: right">
            <a class="btn btn-info" href="{{route('dashboard')}}">Powrót</a>
        </span>
            <br><br>
        </p>

    </div>

    <table class="table table-hover">
        <tr>
            <th>PRZEDMIOT</th>
            <th>OCENY</th>
            <th>ŚREDNIA</th>
        </tr>
        @foreach($marks as $mark)
            <tr>

                <td>{{ \App\Models\Subjects::where('id','=',$mark->subjects_id)->first()->name }}</td>
                <td>
                    <?php
                    $sum_mark = 0;
                    $sum_mark_weight = 0;
                    $result_mark = 0;
                    $mark_subjects = DB::table('marks')->where('subjects_id','=',$mark->subjects_id)->where('students_id','=',$id)->get();

                    foreach ($mark_subjects as $ma_su){
                        $sum_mark = $sum_mark + ($ma_su->mark * $ma_su->weight);
                        $sum_mark_weight = $sum_mark_weight + $ma_su->weight;
                     echo '<button type="button" class="btn btn-outline-dark" data-toggle="tooltip" data-html="true" title="Waga: '.$ma_su->weight.'&#013Opis: '.$ma_su->description.' ">
                                '.$ma_su->mark_desc.'
                                        </button>';
                    }
                    ?>

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


@endsection


