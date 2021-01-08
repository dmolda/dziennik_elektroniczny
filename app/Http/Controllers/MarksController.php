<?php

namespace App\Http\Controllers;

use App\Http\Requests\MarkMultipleRequest;
use App\Models\ClassesHasSubjects;
use App\Models\Marks;
use App\Models\Students;
use App\Models\Teachers;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\MarkRequest;

class MarksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $class_list = DB::table('classes_has_subjects_view')->where('teachers_id','=',Teachers::where('users_id','=',Auth::user()->id)->first()->id)->get();

        return view('marks.index',['class_list'=>$class_list]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\MarkRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(MarkRequest $request)
    {


        if($request->get('mark_desc') === '1'){
            $mark = 1;
        }elseif($request->get('mark_desc') === '+1'){
            $mark = 1.3;
        }elseif($request->get('mark_desc') === "-2"){
            $mark = 1.7;
        }elseif($request->get('mark_desc') === "2"){
            $mark = 2;
        }elseif($request->get('mark_desc') === "+2"){
            $mark = 2.3;
        }elseif($request->get('mark_desc') === "-3"){
            $mark = 2.7;
        }elseif($request->get('mark_desc') === "3"){
            $mark = 3;
        }elseif($request->get('mark_desc') === "+3"){
            $mark = 3.3;
        }elseif($request->get('mark_desc') === "-4"){
            $mark = 3.7;
        }elseif($request->get('mark_desc') === "4"){
            $mark = 4;
        }elseif($request->get('mark_desc') === "+4"){
            $mark = 4.3;
        }elseif($request->get('mark_desc') === "-5"){
            $mark = 4.7;
        }elseif($request->get('mark_desc') === "5"){
            $mark = 5;
        }elseif($request->get('mark_desc') === "+5"){
            $mark = 5.3;
        }elseif($request->get('mark_desc') === "-6"){
            $mark = 5.7;
        }elseif($request->get('mark_desc') === "6"){
            $mark = 6;
        }



        DB::table("marks")->insert([
            'mark_desc' => $request->get('mark_desc'),
            'mark' => $mark,
            'description' => $request->get('description'),
            'weight' => $request->get('weight'),
            'students_id' => $request->get('students_id'),
            'teachers_id' => $request->get('teachers_id'),
            'subjects_id' => $request->get('subjects_id'),
            'classes_id' => $request->get('classes_id'),
            'created_at' => now(),
            'updated_at' => now()
            ]);

        return redirect()->route('marks.show_class', $request->get('classes_has_subjects_id'));


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  MarkMultipleRequest $request
     * @return \Illuminate\Http\Response
     */
    public function multiple_store(MarkMultipleRequest $request)
    {
        $count_students = \App\Models\Students::where('classes_id', '=', $request->get('classes_id'))->count();
        for($i=1;$i<=$count_students;$i++){
            if(!empty($request->get($i))) {
                $mark = Marks::getMark($request->get($i));
                $student_id = $request->get("student".$i);
                DB::table("marks")->insert([
                    'mark_desc' => $request->get($i),
                    'mark' => $mark,
                    'description' => $request->get('description'),
                    'weight' => $request->get('weight'),
                    'students_id' => $student_id,
                    'teachers_id' => $request->get('teachers_id'),
                    'subjects_id' => $request->get('subjects_id'),
                    'classes_id' => $request->get('classes_id'),
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
        }
        return redirect()->route('marks.show_class', $request->get('classes_has_subjects_id'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete_mark($id)
    {

        print_r($id);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $class_id = Students::where('id', '=', $id)->first()->classes_id;
        $marks = DB::table('classes_has_subjects')->select('subjects_id')->where('classes_id', '=', $class_id)->distinct()->get();
        return view('marks.show',['marks'=>$marks],['id'=> $id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show_class($id)
    {
        $data['class_id'] = ClassesHasSubjects::where('id','=',$id)->first()->classes_id;
        $data['classes_has_subjects_id'] = $id;
        $data['subjects_id'] = ClassesHasSubjects::where('id','=',$id)->first()->subjects_id;
        $data['teachers_id'] = ClassesHasSubjects::where('id','=',$id)->first()->teachers_id;
        $students_list = Students::where('classes_id','=',$data['class_id'])->get();

        return view('marks.show_class',['students_list' => $students_list],['data' => $data]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\MarkRequest $request
     * @return \Illuminate\Http\Response
     */
    public function update(MarkRequest $request)
    {

if ($_POST['submit'] == "delete") {
    $marks = Marks::find($request->id);
    $marks->delete();
}elseif($_POST['submit'] == "save"){

    if($request->get('mark_desc') === '1'){
        $mark = 1;
    }elseif($request->get('mark_desc') === '+1'){
        $mark = 1.3;
    }elseif($request->get('mark_desc') === "-2"){
        $mark = 1.7;
    }elseif($request->get('mark_desc') === "2"){
        $mark = 2;
    }elseif($request->get('mark_desc') === "+2"){
        $mark = 2.3;
    }elseif($request->get('mark_desc') === "-3"){
        $mark = 2.7;
    }elseif($request->get('mark_desc') === "3"){
        $mark = 3;
    }elseif($request->get('mark_desc') === "+3"){
        $mark = 3.3;
    }elseif($request->get('mark_desc') === "-4"){
        $mark = 3.7;
    }elseif($request->get('mark_desc') === "4"){
        $mark = 4;
    }elseif($request->get('mark_desc') === "+4"){
        $mark = 4.3;
    }elseif($request->get('mark_desc') === "-5"){
        $mark = 4.7;
    }elseif($request->get('mark_desc') === "5"){
        $mark = 5;
    }elseif($request->get('mark_desc') === "+5"){
        $mark = 5.3;
    }elseif($request->get('mark_desc') === "-6"){
        $mark = 5.7;
    }elseif($request->get('mark_desc') === "6"){
        $mark = 6;
    }

        DB::table("marks")
            ->where('id',$request->id)
            ->update([
                'mark' => $mark,
                'mark_desc' => $request->mark_desc,
                'description' => $request->description,
                'weight' => $request->weight,
                'updated_at' => now()
            ]);


}
        return redirect()->route('marks.show_class', $request->get('classes_has_subjects_id'));

//
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
