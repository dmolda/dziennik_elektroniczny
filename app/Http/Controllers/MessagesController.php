<?php

namespace App\Http\Controllers;

use App\Http\Requests\MessagesRequest;
use App\Models\Messages;
use App\Models\Parents;
use App\Models\ParentsHasStudents;
use App\Models\Students;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class MessagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $messages_list = Messages::where('recipient','=',Auth::user()->id)->orderBy('created_at', 'DESC')->paginate(10);
        return view('messages.index', compact('messages_list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
            return view('messages.create');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create_mass_message()
    {
        return view('messages.create_mass_message');
    }

    public function search(Request $request)
    {
        if ($request->ajax()) {
            if (isset($request->class)) {
                $output = "";
                $classes = DB::table('classes')
                    ->where('name', 'LIKE', '%' . $request->search . "%")
                    ->take(5)
                    ->get();

                if ($classes) {
                    foreach ($classes as $key => $class) {
                        $output .= '<tr>' .
                            '<td>' . '  <input type="radio" id="recipient" name="recipient" value="' . $class->id . '">
                                   <label for="scales">' . $class->name . '</label></td>' .
                            '</tr>';
                    }
                    return Response($output);
                }
            } elseif(isset($request->users)){
                $output = "";
                $students = DB::table('students')
                    ->where('name', 'LIKE', '%' . $request->search . "%")
                    ->orWhere('last_name', 'LIKE', '%' . $request->search . "%")
                    ->take(5)
                    ->get();

                $teachers = DB::table('teachers')
                    ->where('name', 'LIKE', '%' . $request->search . "%")
                    ->orWhere('last_name', 'LIKE', '%' . $request->search . "%")
                    ->take(5)
                    ->get();

                $parents = DB::table('parents')
                    ->where('name', 'LIKE', '%' . $request->search . "%")
                    ->orWhere('last_name', 'LIKE', '%' . $request->search . "%")
                    ->take(5)
                    ->get();
                $i = 0;


                if ($students) {

                    foreach ($students as $key => $user) {
                        if($i==0){
                            $output .= '<tr><td colspan="5"><center><b>Studenci</b></center></td></tr><tr>';
                        }
                        $i=1;
                        $output .=
                            '<td>' . '  <input type="radio" id="recipient" name="recipient" value="' . $user->users_id . '">
                                   <label for="scales">' . $user->name . ' ' .$user->last_name . '</label></td>';
                    }
                    $output .= '</tr>';
                }
                $i = 0;

                if ($teachers) {

                    foreach ($teachers as $key => $user) {
                        if($i==0){
                            $output .= '<tr><td colspan="5"><center><b>Nauczyciele</b></center></td></tr><tr>';
                        }
                        $i=1;
                        $output .=
                            '<td>' . '  <input type="radio" id="recipient" name="recipient" value="' . $user->users_id . '">
                                   <label for="scales">' . $user->name . ' ' .$user->last_name . '</label></td>';
                    }
                    $output .= '</tr>';
                }
                $i = 0;

                if ($parents) {

                    foreach ($parents as $key => $user) {
                        if($i==0){
                            $output .= '<tr><td colspan="5"><center><b>Rodzice</b></center></td></tr><tr>';
                        }
                        $i=1;
                        $output .=
                            '<td>' . '  <input type="radio" id="recipient" name="recipient" value="' . $user->users_id . '">
                                   <label for="scales">' . $user->name . ' ' .$user->last_name . '</label></td>';
                    }
                    $output .= '</tr>';
                }
                $i = 0;
                return Response($output);
            }
        }
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\MessagesRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(MessagesRequest $request)
    {
//        print_r($request->all());
        DB::table('messages')->insert([
           'recipient' => $request->recipient,
            'sender' => Auth::user()->id,
            'message' => $request->message,
            'message_subject' => $request->message_subject,
            'status' => 'new',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        $messages_list = Messages::where('recipient','=',Auth::user()->id)->orderBy('created_at', 'DESC')->paginate(10);
        return view('messages.index', compact('messages_list'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\MessagesRequest $request
     * @return \Illuminate\Http\Response
     */
    public function multiple_store(MessagesRequest $request)
    {
        $students = Students::where('classes_id','=', $request->recipient)->get();
        if(isset($request->parents_only_message)){
            foreach ($students as $student) {
                $parents = ParentsHasStudents::where('students_id', '=', $student->id)->get();
                foreach ($parents as $parent) {
                    $user_id_parent = Parents::find($parent->parents_id)->users_id;
                    DB::table('messages')->insert([
                        'recipient' => $user_id_parent,
                        'sender' => Auth::user()->id,
                        'message' => $request->message,
                        'message_subject' => $request->message_subject,
                        'status' => 'new',
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);
                }
            }

        }else {

            foreach ($students as $student) {
                DB::table('messages')->insert([
                    'recipient' => $student->users_id,
                    'sender' => Auth::user()->id,
                    'message' => $request->message,
                    'message_subject' => $request->message_subject,
                    'status' => 'new',
                    'created_at' => now(),
                    'updated_at' => now()
                ]);

                if (isset($request->parents_message)) {
                    $parents = ParentsHasStudents::where('students_id', '=', $student->id)->get();
                    foreach ($parents as $parent) {
                        $user_id_parent = Parents::find($parent->parents_id)->users_id;
                        DB::table('messages')->insert([
                            'recipient' => $user_id_parent,
                            'sender' => Auth::user()->id,
                            'message' => $request->message,
                            'message_subject' => $request->message_subject,
                            'status' => 'new',
                            'created_at' => now(),
                            'updated_at' => now()
                        ]);
                    }
                }
            }
        }

        $messages_list = Messages::where('recipient','=',Auth::user()->id)->orderBy('created_at', 'DESC')->paginate(10);
        return view('messages.index', compact('messages_list'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $message = Messages::find($id);
        if($message->status == 'new' && $message->recipient == Auth::user()->id){
            Messages::where('id',$id)
                ->update([
                    'status'=>'opened'
                ]);
        }
        if($message->recipient == Auth::user()->id OR Auth()->user()->hasAnyRole(['Administrator'])){
            return view('messages.show',['message' => $message]);
        }else{
            $messages_list = Messages::where('recipient','=',Auth::user()->id)->orderBy('created_at', 'DESC')->paginate(10);
            return view('messages.index', compact('messages_list'));
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show_user_message($id)
    {
        $messages = Messages::where('recipient',$id)->paginate(10);
        return view('messages.show_user_message',['messages' => $messages],['id' => $id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function messages_sent($id)
    {
        $messages = Messages::where('sender',$id)->paginate(10);
        return view('messages.messages_sent',['messages' => $messages]);
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
        Messages::where('id',$id)
            ->update(['status'=>'deleted']);
        if(Auth()->user()->hasAnyRole(['Administrator'])){
            return redirect()->route('messages.show_user_message', Messages::find($id)->recipient);
        }

        $messages_list = Messages::where('recipient','=',Auth::user()->id)->orderBy('created_at', 'DESC')->paginate(10);
        return view('messages.index', compact('messages_list'));
    }
}
