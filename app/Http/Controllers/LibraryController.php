<?php

namespace App\Http\Controllers;

use App\Library;
use App\School;
use Illuminate\Http\Request;


class LibraryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->role->name == "super_admin") {
            $libraries = Library::all();
            $schools = School::all();
        }
        if (auth()->user()->role->name == "admin") {
            $schools = null;
            $libraries = Library::where('school_id', auth()->user()->school->id)->get();
            $schools = null;
        }
        return view('admin.library.index', compact(['libraries','schools']));
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

            $this->validate($request, [
                'school_id' => auth()->user()->role->name == "super_admin" ? 'required' : '',
                'book_price' => 'required',
                'edition' => 'required',
                'publisher' => 'required',
                'book_name' => 'required',
                'book_id' => 'required',
            ]);


        $books = Library::where('book_id', $request->book_id)->where('school_id', auth()->user()->role->name == "super_admin" ? $request->school_id : auth()->user()->school->id)->first();
        $data = $request->all();
        $data['school_id'] = auth()->user()->role->name == "super_admin" ? $request->school_id : auth()->user()->school->id;
        if (empty($books)){
            Library::create($data);
            return redirect()->route('library.index')->with('success', 'Book created Successfully');
        }else{
            return redirect()->route('library.index')->with('error', 'You have entered Duplicate Book ID');
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
