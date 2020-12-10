<?php

namespace App\Http\Controllers;

use App\Models\ClassesHasSubjects;
use App\Models\Students;
use App\Models\Teachers;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;

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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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
        //
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
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
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
