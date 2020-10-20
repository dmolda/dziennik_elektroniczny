<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClassesRequest;
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
     * @param  Classes $class
     * @return \Illuminate\Http\Response
     */
    public function show(Classes $class)
    {
        $students_list = Students::where('classes_id', $class->id)->get();
        return view('classes.show',['class' => $class, 'students_list' => $students_list]);
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
}
