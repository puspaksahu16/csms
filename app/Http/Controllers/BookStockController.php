<?php

namespace App\Http\Controllers;

use App\Book;
use App\BookStock;
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
        $stocks = BookStock::all();
        return view('admin.book_stocks.index', compact('stocks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $books = Book::all();
        return view('admin.book_stocks.create', compact(['books']));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function fetchBookDetails(Request $request)
    {
        $selectedbook = Book::find($request->book_id);

        return response([
            'class_id' => $selectedbook->classes->create_class,
            'publisher_id' => $selectedbook->publisher->name,
            'subject_id' => $selectedbook->subject->name,
            'book_id' => $request->book_id
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        foreach($request->books as $book)
        {
            $stock = BookStock::find($book['book_id']);
            if (!empty($stock))
            {
                $stock_in = $stock->stock_in + $book['quantity'];
                $stock->update(['stock_in' => $stock_in]);
            }else{
                $book_stock = new BookStock();
                $book_stock->create(['book_id' => $book['book_id'], 'stock_in' => $book['quantity']]);
            }
        }
        return response(['success']);
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
