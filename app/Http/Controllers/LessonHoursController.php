<?php

namespace App\Http\Controllers;

use App\Models\LessonHours;
use Illuminate\Http\Request;
use DB;

class LessonHoursController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lesson_hours = LessonHours::orderBy('time','ASC')->get();
        return view('lesson_hours.index',compact('lesson_hours'));
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $lesson_hours = LessonHours::orderBy('time','ASC')->get();
        return view('lesson_hours.edit',['lesson_hours'=>$lesson_hours],['id'=>$id]);
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

        for($i=1;$i<=12;$i++){
            $start_time = "start_time|" . $i;
            $end_time = "end_time|" . $i;
            DB::table('lesson_hours')
                ->where('time', $i)
                ->update([
                   'start_time' => $request->get($start_time),
                   'end_time' => $request->get($end_time),
                    'updated_at' => now()
                ]);

        }

        $lesson_hours = LessonHours::orderBy('time','ASC')->get();
        return view('lesson_hours.index',compact('lesson_hours'));

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
