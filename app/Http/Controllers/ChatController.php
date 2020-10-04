<?php

namespace App\Http\Controllers;

use App\Chat;
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
            $chats = Chat::all();
        }
        if (auth()->user()->role->name == "admin"){
            $chats = Chat::where('school_id', auth()->user()->school->id)->get();
        }

        if (auth()->user()->role->name == "parent"){
            $chats = Chat::where('parent_id', auth()->user()->id)->get();
        }

        return view('admin.chat.index', compact(['chats']));
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
        $parents = StudentParent::with('students')->where('user_id',auth()->user()->id)->get();

        foreach ($parents as $key => $p){
           $school = $p->students->school_id;
        }

        $chat = new Chat();
        $chat->message = $request->message;
        $chat->school_id = $school;
        $chat->parent_id = auth()->user()->id;
        $chat->save();
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
