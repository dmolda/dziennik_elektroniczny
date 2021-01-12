<?php

namespace App\Http\Controllers;

use App\Http\Requests\TeachersRequest;
use App\Models\Roles;
use App\Models\RolesHasUsers;
use App\Models\Teachers;
use App\Models\TeachersHasSubject;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TeachersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teacher_list = Teachers::orderBy('id','DESC')->paginate(10);

        return view('teachers.index',compact('teacher_list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('teachers.create');
    }


    public function search_teachers(Request $request)
    {
        if ($request->ajax()) {
            $output = "";
            $teachers = DB::table('teachers')
                ->where('name', 'LIKE', '%' . $request->search . "%")
                ->orWhere('second_name', 'LIKE', '%' . $request->search . "%")
                ->orWhere('last_name', 'LIKE', '%' . $request->search . "%")
                ->offset(10)
                ->limit(5)
                ->get();

            if ($teachers) {

                foreach ($teachers as $key => $teacher) {
                    $output .= '<tr>' .
                        '<td>' . $teacher->name . " " . $teacher->second_name . '</td>' .
                        '<td>' . $teacher->last_name . '</td>' .
                        '<td>' . '<a class="btn btn-info" href="' . route('teachers.manage_subjects', $teacher->id).'"> Zarządzaj przedmiotami</a>' . '</td>' .
                        '<td>' . Users::find($teacher->users_id)->name . '</td>' .
                        '<td>' . '<a class="btn btn-info" href="' . route('teachers.edit', $teacher->id).'"> <i class="fas fa-user-edit"></i></a>' . '</td>' .
                        '<td> <form method="POST" action='.route('teachers.destroy', $teacher->id).' accept-charset="UTF-8">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="_token" value="' . csrf_token() . '">
                                <button class="btn btn-danger" onclick="return confirm(\'Potwierdź usunięcie nauczyciela!\')"><i class="far fa-trash-alt"></i></button>
                                </form></td>' .
                        '</tr>';
                }
                return Response($output);
            }
        }
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $teacher_role_id = Roles::where('name','nauczyciel')->first()->id;

        if(Teachers::where('users_id','=', $request->get('users_id'))->exists()) {
            $teacher_id = Teachers::where('users_id','=', $request->get('users_id'))->first()->id;
            DB::table('teachers_has_subjects')->insert(
              ['teachers_id' => $teacher_id,
                  'subjects_id' => $request->get('subjects_id'),
                  'created_at' => now(),
                  'updated_at' => now()]
            );
        }else{
            DB::table('roles_has_users')->insert(
              ['users_id' => $request->get('users_id'),
                  'roles_id' => $teacher_role_id,
                  'created_at' => now(),
                  'updated_at' => now()]
            );

            $teacher_id = DB::table('teachers')->insertGetId(
              ['users_id' => $request->get('users_id'),
                  'created_at' => now(),
                  'updated_at' => now()]
            );

            DB::table('teachers_has_subjects')->insert(
              ['teachers_id' => $teacher_id,
                  'subjects_id' => $request->get('subjects_id'),
                  'created_at' => now(),
                  'updated_at' => now()]
            );
        }

        $results = ['users_id' => $request->get('users_id'), 'roles_id' => $teacher_role_id];
        if(!RolesHasUsers::where($results)->exists()) {
            DB::table('roles_has_users')->insert(
              ['users_id' => $request->get('users_id'),
                  'roles_id' => $teacher_role_id,
                  'created_at' => now(),
                  'updated_at' => now()]
            );
        }
        $teacher_list = Teachers::orderBy('id','DESC')->paginate(10);
        return view('teachers.index',compact('teacher_list'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $teacher = Teachers::find($id);
        return view('teachers.show',['teacher' => $teacher]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function manage_subjects($id)
    {
        $subjects = TeachersHasSubject::where('teachers_id',$id)->get();
        return view('teachers.manage_subjects',['subjects' => $subjects],['id' => $id]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Teachers $teacher
     * @return \Illuminate\Http\Response
     */
    public function edit(Teachers $teacher)
    {
        return view('teachers.edit', compact('teacher'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  TeachersRequest $request
     * @param  Teachers $teacher
     * @return \Illuminate\Http\Response
     */
    public function update(TeachersRequest $request, Teachers $teacher)
    {
        if(empty($request->get('second_name'))){
            $teacher->update($request->only('name','last_name','date_of_birth','sex'));
        }else{
            $teacher->update($request->only('name','second_name','last_name','date_of_birth','sex'));
        }
        return redirect()->route('teachers.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $teacher = Teachers::find($id);
        $teacher->delete();
        return redirect()->back();
    }
}
