<?php

namespace App\Http\Controllers;

use App\Chat;
use App\School;
use App\Student;
use App\StudentParent;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->role->name == "super_admin"){
            $schools = School::all();
            $parents = StudentParent::all();
            $chats = Chat::all();
        }
        if (auth()->user()->role->name == "admin"){
            $students = Student::with('parent:student_id,mother_email,id')->where('school_id', auth()->user()->school->id)->get();
            $parents = [];
            foreach ($students as $key => $st){
                array_push($parents,$st->parent);
            }

            $chats = Chat::where('school_id', auth()->user()->school->id)->get();
        }

        if (auth()->user()->role->name == "parent"){
            $chats = Chat::where('parent_id', auth()->user()->parent->id)->get();
        }

        return view('admin.chat.index', compact(['chats','schools','parents']));
    }
    public function getParent($id)
    {
//
//  ->pluck("mother_email", 'id')
        $students = Student::with('parent:student_id,mother_email,id')->where('school_id', $id)->get();
        $parents = [];
        foreach ($students as $key => $st){
            array_push($parents,$st->parent);
        }
        return $parents;
        return response($parents);
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
        if (auth()->user()->role->name == "super_admin"){

            $chat = new Chat();
            $chat->message = $request->message;
            $chat->school_id = $request->school_id;
            $chat->parent_id = $request->parent_id;
            $chat->save();
        }

        if (auth()->user()->role->name == "admin"){
            $chat = new Chat();
            $chat->message = $request->message;
            $chat->school_id = auth()->user()->school->id;
            $chat->parent_id = $request->parent_id;
            $chat->save();
        }
        if (auth()->user()->role->name == "parent"){
            $parents = StudentParent::with('students')->where('student_id',auth()->user()->parent->id)->get();

            foreach ($parents as $key => $p){
                $school = $p->students->school_id;
            }

            $chat = new Chat();
            $chat->message = $request->message;
            $chat->school_id = $school;
            $chat->parent_id = auth()->user()->parent->id;
            $chat->save();
        }

        return redirect()->route('chat.index')->with('success', 'Message Send Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('admin.chat.view');
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
        //
    }
}
