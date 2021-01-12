<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentsRequest;
use App\Models\Classes;
use App\Models\Roles;
use App\Models\Students;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Users;

class StudentsController extends Controller
{

    public function index()
    {
        $student_list = Students::orderBy('id','DESC')->paginate(10);

        return view('students.index',compact('student_list'));
    }


    public function create()
    {
        $class_list = Classes::orderBy('id','ASC')->get();
        return view('students.create',['class_list' => $class_list]);
    }

    public function add()
    {
        $student_list = Students::whereNull('classes_id')->get();
        return view('students.add',['student_list' => $student_list]);
    }


    public function students_search(Request $request)
    {
        if ($request->ajax()) {
            $output = "";
            $students = DB::table('students')
                ->where('name', 'LIKE', '%' . $request->search . "%")
                ->orWhere('second_name', 'LIKE', '%' . $request->search . "%")
                ->orWhere('last_name', 'LIKE', '%' . $request->search . "%")
                ->take(5)
                ->get();

            if ($students) {

                foreach ($students as $key => $student) {
                    $output .= '<tr>' .
                        '<td>' . $student->name . " " . $student->second_name . '</td>' .
                        '<td>' . $student->last_name . '</td>' .
                        '<td>' . Classes::find($student->classes_id)->name . '</td>' .
                        '<td>' . Users::find($student->users_id)->name . '</td>' .
                        '<td>' . '<a class="btn btn-info" href="' . route('students.edit', $student->id).'"> <i class="fas fa-user-edit"></i></a>' . '</td>' .
                        '<td> <form method="POST" action='.route('students.destroy', $student->id).' accept-charset="UTF-8">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="_token" value="' . csrf_token() . '">
                                <button class="btn btn-danger" onclick="return confirm(\'Potwierdź usunięcie ucznia!\')"><i class="far fa-trash-alt"></i></button>
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
        //
        $student_role_id = Roles::where('name','uczen')->first()->id;
        DB::table('roles_has_users')->insert(
          ['users_id' => $request->get('users_id'), 'roles_id' => $student_role_id, 'created_at' => now(), 'updated_at' => now()]
        );

        DB::table('students')->insert(
          ['users_id' => $request->get('users_id'), 'classes_id' => $request->get('classes_id'),'created_at' => now(), 'updated_at' => now()]
        );
        return redirect()->route('students.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeadd(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $student = Students::find($id);
        return view('students.show',['student' => $student]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Students $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Students $student)
    {
        return view('students.edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  StudentsRequest $request
     * @param  Students $student
     * @return \Illuminate\Http\Response
     */
    public function update(StudentsRequest $request, Students $student)
    {
        if(empty($request->get('second_name'))){
            $student->update($request->only('name','last_name','date_of_birth','sex'));
        }else{
            $student->update($request->only('name','second_name','last_name','date_of_birth','sex'));
        }
        return redirect()->route('students.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student = Students::find($id);
        $student->delete();
        return redirect()->back();

    }
}
