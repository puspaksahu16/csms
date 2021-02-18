<?php

namespace App\Http\Controllers;

use App\Book;
use App\BookStock;
use App\Createclass;
use App\School;
use App\Subject;

use Freshbitsweb\Laratables\Laratables;
use Illuminate\Http\Request;

class BookStockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->role->name == "super_admin") {
            $stocks = BookStock::all();
            $schools = School::all();
            $classes = Createclass::all();
        }else{
            $schools = null;
            $stocks = BookStock::where('school_id', auth()->user()->school->id)->get();
            $classes = Createclass::where('school_id', auth()->user()->school->id)->get();
            $schools = null;
        }

        return view('admin.book_stocks.index', compact(['stocks','schools','classes']));
    }

    public function laraBookStock()
    {
       return Laratables::recordsOf(BookStock::class);
    }

    public function fetchBookStockClass( Request $request )
    {
        if (auth()->user()->role->name == "super_admin") {
            $stocks = BookStock::with('schools','book','classes','book.subject','book.publisher')->where('school_id', $request->school_id)->where('class_id', $request->class_id)->get();
        }
        elseif (auth()->user()->role->name == "admin"){
            $stocks = BookStock::with('schools','book','classes','book.subject','book.publisher')->where('school_id', auth()->user()->school->id)->where('class_id', $request->class_id)->get();
        }
        return response($stocks);
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
            $classes = Createclass::where('school_id', auth()->user()->school->id)->get();
        }else{
            $classes = Createclass::all();
        }
        $schools = School::all();

        return view('admin.book_stocks.create', compact(['classes','schools']));
    }
    public function fetchschoolBookstock(Request $request)
    {
        $classes = Createclass::where('school_id', $request->school_id)->get();
        return response($classes);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function fetchSub(Request $request)
    {
        $ss = Book::where('class_id', $request->class_id)->distinct('subject_id')->get('subject_id');
        $subject = Subject::whereIn('id', $ss)->get();

        return response([
            'class_id' => $request->class_id,
            'subject_id' => null,
//            'publisher_id' => '',
//            'book_id' => '',
            'subject' => $subject
        ]);
    }

    public function fetchBook(Request $request)
    {
        $books = Book::where('subject_id', $request->subject_id)->where('class_id', $request->class_id)->get();

        return response([
            'subject_id' => $request->subject_id,
            'books' => $books,
        ]);
    }

    public function fetchBookDetails(Request $request)
    {
        $books = Book::find($request->book_id);
        return response([
            'class_id' => $books->class_id,
            'subject_id' => $books->subject_id,
            'book_id' => $books->id,
            'publisher_id' => $books->publisher->name,
            'price' => $books->price,
        ]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
//    public function store(Request $request)
//    {
//        foreach($request->books as $book)
//        {
//
//            $stock = BookStock::find($book['book_id']);
//            if (!empty($stock))
//            {
//
//                $stock_in = $stock->stock_in + $book['quantity'];
//                $stock->update(['stock_in' => $stock_in]);
//            }else{
//
//                $book_stock = new BookStock();
//                $book_stock->create(['book_id' => $book['book_id'], 'stock_in' => $book['quantity'],'school_id' => $book['school_id'] = auth()->user()->role->name == "admin" ? auth()->user()->school->id : $request->school_id]);
//            }
//        }
//        return response(['success']);
//    }
    public function store(Request $request)
    {
        if (!empty($request->books)) {
            foreach ($request->books as $book) {
                $book['stock_in'] = $book['quantity'];
                $book['last_in'] = $book['quantity'];
                $book['school_id'] = auth()->user()->role->name == "admin" ? auth()->user()->school->id : $request->school_id ;
                $availables = BookStock::where('school_id', $book['school_id'])
                    ->where('book_id', $book['book_id'])
                    ->get();


                if (count($availables) <= 0) {
                    $createstock = new BookStock();
                    $createstock->create($book);
                }
                else{
                    $update = BookStock::find($availables[0]['id']);
                    $update->stock_in = $availables[0]['stock_in'] + $book['quantity'];
                    $update->last_in = $book['quantity'];
                    $update->update();
                }
            }
            return response(['success']);
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
        $book_stocks = BookStock::find($id);
        return view('admin.book_stocks.edit', compact('book_stocks'));
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
        $update = BookStock::find($id);
        $update->description = $request->description;
        $update->stock_in = $update->stock_in - $update->last_in;
        $update->last_in = 0;
        $update->update();
        return redirect()->route('book_stocks.index')->with('success', 'last stock removed Successfully');
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
