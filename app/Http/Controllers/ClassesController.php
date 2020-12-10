<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClassesRequest;
use App\Models\ClassesHasSubjects;
use App\Models\Students;
use Illuminate\Http\Request;
use App\Models\Classes;
use Illuminate\Support\Facades\DB;

class ClassesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $classes = Classes::orderBy('id','ASC')->paginate(10);

        return view('classes.index',compact('classes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('classes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\ClassesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClassesRequest $request)
    {
        Classes::create($request->all());
        return redirect()->route('classes.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function add_subject($id)
    {

        $class = Classes::where('id', $id)->first();

        return view('classes.add_subject',['class'=>$class,'id'=>$id]);
    }
//    /**
//     * Display the specified resource.
//     *
//     * @param  int  $id
//     * @return \Illuminate\Http\Response
//     */
//    public function add_subject(int  $id)
//    {
//
//        return view('classes.add_subject',['id'=>$id]);
//    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_add_subject(Request $request)
    {

        DB::table('Classes_Has_Subjects')->insert([
        'classes_id' => $request->get('classes_id'),
        'subjects_id' => $request->get('subjects_id'),
        'teachers_id' => $request->get('teachers_id'),
            'created_at' => now(),
            'updated_at' => now(),
    ]);
//        ClassesHasSubjects::create($request->all());
        return redirect()->back();



    }

    public function getTeacher($id){
        $userData['data'] = ClassesHasSubjects::getTeacher($id);


        echo json_encode($userData);
        exit;
    }

    /**
     * Display the specified resource.
     *
     * @param  Classes $class
     * @return \Illuminate\Http\Response
     */
    public function show(Classes $class)
    {
        $students_list = Students::where('classes_id', $class->id)->get();
        return view('classes.show',['class' => $class, 'students_list' => $students_list]);
    }
    /**
     * Display the specified resource.
     *
     * @param  Classes $class
     * @return \Illuminate\Http\Response
     */
    public function subjects(Classes $class)
    {
        $subjects_list = ClassesHasSubjects::where('classes_id','=', $class->id)->get();
        return view('classes.subjects', ['class' => $class, 'subjects_list' => $subjects_list]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Classes $class
     * @return \Illuminate\Http\Response
     */
    public function edit(Classes $class)
    {
        return view('classes.edit',compact('class'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\ClassesRequest  $request
     * @param  Classes $class
     * @return \Illuminate\Http\Response
     */
    public function update(ClassesRequest  $request, Classes $class)
    {
        $class->update($request->all());
        return redirect()->route('classes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Classes $class
     * @return \Illuminate\Http\Response
     */
    public function destroy(Classes $class)
    {

        $class->delete();
        return redirect()->route('classes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function delete(int $id)
    {

        echo $id;
    }
}
