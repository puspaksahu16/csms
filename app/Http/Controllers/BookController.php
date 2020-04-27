<?php

namespace App\Http\Controllers;

use App\Book;
use App\Createclass;
use App\Publisher;
use App\School;
use App\Standard;
use App\Subject;
use Freshbitsweb\Laratables\Laratables;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->role->name == "super_admin") {
            $books = Book::all();
        }
        else{
            $books = Book::where('school_id', auth()->user()->school->id)->get();
        }
        return view('admin.books.index', compact('books'));
    }

    public function laraBooks()
    {
        return Laratables::recordsOf(Book::class);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (auth()->user()->role->name == "admin")
        {
            $standards = Standard::where('school_id', auth()->user()->school->id)->get();
        }else{
            $standards = Standard::all();
        }
        $schools = School::all();
        $publishers = Publisher::all();
        $subjects = Subject::all();
        return view('admin.books.create', compact(['standards', 'publishers', 'subjects', 'schools']));
    }
    public function fetchschoolBook(Request $request)
    {
        $standards = Standard::where('school_id', $request->school_id)->get();
        return response($standards);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function bookFeeUpdate()
    {
        if (auth()->user()->role->name == "admin")
        {
            $classes = Createclass::where('school_id', auth()->user()->school->id)->get();
        }else{
            $classes = Createclass::all();
        }
        $schools = School::all();

        return view('admin.books.book_fee_update', compact(['classes','schools']));
    }
    public function fetchschoolBookPrice(Request $request)
    {
        $classes = Createclass::where('school_id', $request->school_id)->get();
        return response($classes);
    }
    public function bookFee()
    {
        if (auth()->user()->role->name == "super_admin") {
            $books = Book::all();
        }else{
            $books = Book::where('school_id', auth()->user()->school->id)->get();
        }

        return view('admin.books.book_fee', compact('books'));
    }

    /**
     * @param Request $request
     */
    public function updatePrice(Request $request)
    {
        foreach($request->books as $book)
        {
            $stock = Book::find($book['book_id']);
            $stock->update(['price' => $book['price']]);
        }
        return response(['success']);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function fetchClass(Request $request)
    {
        $classes = Createclass::where('standard_id', $request->standard_id)->get();
        return response($classes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!empty($request->books)){
            foreach ($request->books as $book) {
                $book['school_id'] = auth()->user()->role->name == "admin" ? auth()->user()->school->id : $request->school_id;
                $createbook = new Book();
                $createbook->create($book);
            }
            return response(["success"]);
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
        $books = Book::find($id);
        $classes = Createclass::all();
        $subject = Subject::all();
        $publisher = Publisher::all();
        $standard = Standard::all();
        return view('admin.books.edit', compact(['books','standard','publisher','subject','classes']));
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
        Book::find($id)->update($request->all());
        return redirect('/books')->with('message', 'Status changed!');
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
