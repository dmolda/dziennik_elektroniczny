<?php

namespace App\Http\Controllers;

use App\Models\RolesHasUsers;
use Illuminate\Http\Request;
use App\Models\Roles;
use Illuminate\Support\Facades\DB;
class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = $_GET['user_id'];
        $roles_name = DB::table('roles_has_users')
            ->join('roles','roles_id','=','roles.id')
            ->join('users','users_id','=','users.id')
            ->select('roles.name','roles_has_users.id')
            ->where('roles_has_users.users_id','=',$user_id)
            ->orderBy('roles.id','ASC')
            ->get();
        return view('roles.index',['roles_name' => $roles_name],['user_id'=> $user_id]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        RolesHasUsers::create($request->all());
        $user_id = "user_id=".$request->get('users_id');
        return redirect()->route('roles.index', $user_id);
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
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        DB::table('roles_has_users')
            ->where('id', '=', $id)
            ->delete();
        return redirect()->back();
    }
}
