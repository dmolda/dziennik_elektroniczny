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

    public function search_users(Request $request)
    {
        if ($request->ajax()) {
            $output = "";
            $result_users = DB::table('users')
                ->where('name', 'LIKE', '%' . $request->search . "%")
                ->orWhere('email', 'LIKE', '%' . $request->search . "%")
                ->offset(10)
                ->limit(5)
                ->get();

            if ($result_users) {

                    foreach ($result_users as $key => $result) {
                        $output .= '<tr>' .
                            '<td>' . $result->name . '</td>' .
                            '<td>' . $result->email . '</td>' .
                            '<td>' . '<a class="btn btn-info" href="/roles?user_id=' . $result->id . '"> Zarządzaj rolami</a>' . '</td>' .
                            '<td>  <table>
                                    <td>' . '<a class="btn btn-info" href="' . route('users.edit', $result->id) . '"> <i class="fas fa-user-edit"></i></a>' . '</td>
                                    <td> <form method="POST" action='.route('users.destroy', $result->id).' accept-charset="UTF-8">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="_token" value="' . csrf_token() . '">
                                <button class="btn btn-danger" onclick="return confirm(\'Potwierdź usunięcie użytkownika!\')"><i class="far fa-trash-alt"></i></button>
                                </form></td>
                                <td>' . '<a class="btn btn-info" href="' . route('messages.show_user_message', $result->id) . '"> <i class="far fa-envelope-open"></i></a>' . '</td>
                                    </table>  </td>' .
                            '</tr>';
                }
                return Response($output);
            }
        }
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
     * @param  \App\Models\Users $user
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
