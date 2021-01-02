<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\ClassesHasSubjects;
use App\Models\Schedules;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SchedulesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $classes = Classes::orderBy('id','ASC')->get();

        return view('schedules.index',compact('classes'));
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
        if(Schedules::where('id',$id)->exists()) {
        $schedule = Schedules::where('id',$id)->first();
            return view('schedules.show',['schedule'=>$schedule],['id'=>$id]);
        }else{
            return view('schedules.show',compact('id'));
        }

    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show_teacher($id)
    {

            $schedule = Schedules::where('teachers_id',$id)->first();
            return view('schedules.show_teacher',['schedule'=>$schedule],['id'=>$id]);


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $subjects = DB::table('classes_has_subjects')
            ->join('classes','classes_id','=','classes.id')
            ->join('subjects','subjects_id','=','subjects.id')
            ->join('teachers','teachers_id','=','teachers.id')
            ->select('subjects.name','teachers.name as teachers_name','teachers.second_name','teachers.last_name','classes_has_subjects.id')
            ->where('classes_has_subjects.classes_id','=',$id)
            ->orderBy('subjects.name','ASC')
            ->get();

        return view('schedules.edit', ['subjects'=>$subjects],['id'=>$id]);
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
        for($i=1;$i<=12;$i++) {
            for ($j = 1; $j <= 5; $j++) {
                $value = $i . "|" . $j;
                if($request->exists($value)){
                    if($request->get($value) == 'DELETE'){
                        DB::table('schedules')->where([
                            'time' => $i,
                            'day' => $j,
                            'classes_id' => $id,
                        ])->delete();
                    }else{
                        $classes_has_subjects = ClassesHasSubjects::where('id','=',$request->get($value))->first();
                        if(DB::table('schedules')->where([ 'time' => $i, 'day' => $j, 'classes_id' => $id, ])->exists()){
                            DB::table('schedules')->where([ 'time' => $i, 'day' => $j, 'classes_id' => $id])
                                ->update([
                                    'teachers_id' => $classes_has_subjects->teachers_id,
                                    'subjects_id' => $classes_has_subjects->subjects_id,
                                    'updated_at' => now()
                                ]);
                        }else{
                            DB::table('schedules')->insert([
                                'time' => $i,
                                'day' => $j,
                                'teachers_id' => $classes_has_subjects->teachers_id,
                                'subjects_id' => $classes_has_subjects->subjects_id,
                                'classes_id' => $classes_has_subjects->classes_id,
                                'created_at' => now(),
                                'updated_at' => now()
                            ]);
                        }
                    }
                }
            }
        }
        return redirect()->route('schedules.show', $id);
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
