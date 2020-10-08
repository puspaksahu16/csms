<?php

namespace App\Http\Controllers;

use App\IssueBook;
use App\Library;
use App\School;
use App\Student;
use Illuminate\Http\Request;

class IssueBookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->role->name == "super_admin") {
            $issue_books = IssueBook::where('status',0)->get();
            $schools = School::all();
        }
        return view('admin.issue_book.index', compact(['issue_books','schools']));
    }

    public function return()
    {
        if (auth()->user()->role->name == "super_admin") {
            $issue_books = IssueBook::where('status',1)->get();
        }
        return view('admin.return_book.index', compact(['issue_books']));
    }

    public function getStudent($id)
    {
     $students = Student::where('school_id', $id)->get();
     return response($students);
    }

    public function getBooks($id)
    {
        $books = Library::where('school_id', $id)->get();
        return response($books);
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
        $data = $request->all();
        $data['school_id'] = auth()->user()->role->name == "super_admin" ? $request->school_id : auth()->user()->school->id;
        IssueBook::create($data);
        return redirect()->route('issue_book.index')->with('success', 'Book issued Successfully');
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

    public function returnBook(Request $request, $id)
    {
        $issue = IssueBook::find($id);
        $issue->fine = $request->fine;
        $issue->status = 1;
        $issue->update();
        return redirect()->route('issue_book.index')->with('success', 'Book Return Successfully');
    }


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
