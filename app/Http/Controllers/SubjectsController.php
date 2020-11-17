<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubjectsRequest;
use App\Models\Subjects;
use Illuminate\Http\Request;

class SubjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subjects_list = Subjects::orderBy('id','DESC')->paginate(10);
        return view('subjects.index',compact('subjects_list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('subjects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  SubjectsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubjectsRequest  $request)
    {
        Subjects::create($request->all());
        return redirect()->route('subjects.index')->With('message_add','Przedmiot został dodany!');
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
     * Show the form for editing the specified resource.
     *
     * @param  Subjects $subject
     * @return \Illuminate\Http\Response
     */
    public function edit(Subjects $subject)
    {
        return view('subjects.edit', compact('subject'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  SubjectsRequest  $request
     * @param  Subjects $subject
     * @return \Illuminate\Http\Response
     */
    public function update(SubjectsRequest  $request, Subjects $subject)
    {
        $subject->update($request->all());
        return redirect()->route('subjects.index')->With('message_edit','Przedmiot został edytowany!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Subjects $subject
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subjects $subject)
    {
        $subject->delete();
        return redirect()->route('subjects.index');
    }
}
