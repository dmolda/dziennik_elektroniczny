<?php

namespace App\Http\Controllers;

use App\Models\Educators;
use App\Models\Roles;
use App\Models\Teachers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EducatorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $educators_list = Educators::orderBy('id','DESC')->paginate(10);
        return view('educators.index', compact('educators_list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('educators.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::table('roles_has_users')->insert([
                'users_id' => Teachers::where('id','=', $request->get('teachers_id'))->first()->users_id,
                'roles_id' => Roles::where('name','wychowawca')->first()->id,
                'created_at' => now(),
                'updated_at' => now()
            ]
        );

        Educators::create($request->all());
        return redirect()->route('educators.index');
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
     * @param  Educators $educator
     * @return \Illuminate\Http\Response
     */
    public function destroy(Educators $educator)
    {
        $roles_id =  Roles::where('name','=','Wychowawca')->first()->id;

        $user_id = Teachers::where('id','=',$educator->teachers_id)->first()->users_id;

        DB::SELECT(DB::raw("DELETE FROM `roles_has_users` WHERE users_id = '$user_id' AND roles_id = '$roles_id'"));
        $educator->delete();

        return redirect()->route('educators.index');
    }
}
