<?php

namespace App\Http\Controllers;

use App\Http\Requests\NotesRequest;
use Illuminate\Http\Request;
use DB;
use App\Models\Classes;
use App\Models\Notes;

class NotesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('notes.index');
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
                $i = 0;
                foreach ($students as $key => $student) {
                    if ($i==0){
                        $output .= '<tr><td>Uczeń</td><td>Klasa</td><td>Pokaż notatki</td></tr>';
                        $i=1;
                    }
                    $output .= '<tr>' .
                        '<td> <input type="radio" id="students_id" name="students_id" value="' . $student->id . '"><label for="scales">' . $student->name . " " . $student->second_name . " " . $student->last_name . '</label></td>' .

                        '<td>' . Classes::where('id', '=', $student->classes_id)->first()->name . '</td>' .
                        '<td>' . '<a class="btn btn-outline-primary" href="'. route('notes.show', $student->id) .'" role="button">Lista notatek</a>' . '</td>' .
                        '</tr>';
                }
                return Response($output);
            }
        }
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
     * @param  NotesRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(NotesRequest $request)
    {
        Notes::create($request->all());
        return view('notes.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $notes_positive = DB::table('notes')->where([
            'students_id' => $id,
            'type' => 'positive'
        ])->get();
        $notes_negative = DB::table('notes')->where([
            'students_id' => $id,
            'type' => 'negative'
        ])->get();

        return view('notes.show', ['notes_positive' => $notes_positive],['notes_negative' => $notes_negative]);
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
     * @param  Notes $note
     * @return \Illuminate\Http\Response
     */
    public function destroy(Notes $note)
    {
        $note->delete();
        return redirect()->back();
    }
}
