@extends('layout')

@section('page_info')
    Edytowany użytkownik:
    {{ \App\Models\Users::where('id','=',$_GET['user_id'])->first()->name }}
@endsection

@section('content')

    <div class="card-header">
        <p style="text-align: left">
            <span style="float: right">
            <a class="btn btn-info" href="{!! url()->previous() !!}">Powrót</a>
        </span>
        </p>
        <br>
    </div>

    <table class="table table-hover">
        <?php  $user_id=$_GET['user_id']; ?>

        {!! Form::open(['route'=>'roles.store']) !!}
        <div class="form-group">
            {!! Form::hidden('users_id',$user_id) !!}
            {!! Form::label('role', "Wybierz rangę:") !!}
            <select class="form-control" id="roles_id" name="roles_id">
                <option value="" disabled selected>Wybierz opcję</option>
                <?php
                $roles_name = DB::select(DB::raw("SELECT DISTINCT(roles.name),roles.id FROM `roles_has_users`,`users`,`roles` WHERE NOT roles.id = ANY (SELECT roles.id FROM ((`roles`
                                                                                                           INNER JOIN `roles_has_users` ON `roles`.`id` = `roles_has_users`.`roles_id`)
                                                                                                           INNER JOIN `users` ON `roles`.`id` = `users`.`id`)
                                                                                     WHERE `roles_has_users`.`users_id` = $user_id)
                                                                                        AND `roles`.`name` NOT IN ('Wychowawca','Nauczyciel','Uczen','Nowy')
                                                                                     "));
                foreach ($roles_name as $role_name){
                    echo "<option value='$role_name->id'>" . $role_name->name . "</option>";
                }
                ?>


            </select><br>
            {!! Form::submit('Zapisz',['class'=>'btn btn-outline-primary']) !!}



        </div>

        {!! Form::close() !!}

    </table>



@endsection
