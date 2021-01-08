<?php

namespace App\Http\Controllers;

use App\Http\Requests\ParentsRequest;
use App\Models\Classes;
use App\Models\Parents;
use App\Models\ParentsHasStudents;
use App\Models\Students;
use App\Models\Users;
use Illuminate\Http\Request;
use DB;

class ParentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $parents_list = Parents::orderBy('id','DESC')->paginate(10);
        return view('parents.index',compact('parents_list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $students_list = Students::orderBy('id','DESC')->paginate(10);

        return view('parents.create',compact('students_list'));
    }

    public function search(Request $request)
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
                                '<td>' . Classes::where('id', '=', $student->classes_id)->first()->name . '</td>' .
                                '<td>' . Users::where('id', '=', $student->users_id)->first()->name . '</td>' .
                                '<td>    <form method="POST" action='.route('parents.child_add').' accept-charset="UTF-8">
                                <input type="hidden" name="_token" value="' . csrf_token() . '">
                                <input type="hidden" name="parents_id" value="' . $request->parent_id . '">
                                <input type="hidden" name="students_id" value="' . $student->id . '">
                                <input type="submit" class="btn btn-outline-primary" type="submit" value="Dodaj">
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
    public function child_add(Request $request)
    {
        DB::table('parents_has_students')->insert([
            'parents_id' => $request->parents_id,
            'students_id' => $request->students_id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $parents_list = Parents::orderBy('id','DESC')->paginate(10);
        return view('parents.index',compact('parents_list'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $parent = Parents::find($id);

        return view('parents.show', compact('parent'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function child_manage($id)
    {
        $children_list = ParentsHasStudents::where('parents_id','=',$id)->get();

        return view('parents.child_manage', ['children_list' => $children_list],['parent_id'=>$id]);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function child($id)
    {
        $children_list = ParentsHasStudents::where('parents_id', $id)->get();

        return view('parents.child', compact('children_list'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Parents $parent
     * @return \Illuminate\Http\Response
     */
    public function edit(Parents $parent)
    {
        return view('parents.edit', compact('parent'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ParentsRequest $request
     * @param  Parents $parent
     * @return \Illuminate\Http\Response
     */
    public function update(ParentsRequest $request, Parents $parent)
    {
            $parent->update($request->all());
        return redirect()->route('parents.index');
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
