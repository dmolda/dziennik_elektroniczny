<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsersPasswordRequest;
use App\Http\Requests\UsersRequest;
use App\Models\User;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('id','DESC')->paginate(10);

        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\UsersRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsersRequest $request)
    {
        Users::create($request->all());
        return redirect()->route('users.index');
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
     * @param  \App\Users $user
     * @return \Illuminate\Http\Response
     */
    public function edit(Users $user)
    {
        return view('users.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\UsersPasswordRequest  $request
     * @param  Users $user
     * @return \Illuminate\Http\Response
     */
    public function update(UsersPasswordRequest $request, Users $user)
    {
        if (empty($request->get('password'))){

            $user->update($request->only('name','email'));

        }else{

            $user->update($request->only('name','email','password'));

        }
        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Users $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(Users $user)
    {
        $user->delete();
        return redirect()->route('users.index');
    }
}
