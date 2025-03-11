<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use Validator;
use Auth;

class BooksController extends Controller
{

    public function view(Book $books) {
        $books = Book::orderBy('created_at', 'asc')->get();
        return view('books', ['books' => $books]);
        }

    public function update(Request $request){
        $validator = Validator::make($request->all(),[
            'id' => 'required',
            'item_name' => 'required|min:3|max:255',
            'item_number' => 'required|min:1|max:3',
            'item_amount' => 'required|max:6',
            'published' => 'required|date_format:Y-m-d'
        ]);
        if($validator->fails()) {
            return redirect('/')
            ->withInput()
            ->withErrors($validator);
        }
        $books = Book::find($request->id);
        $books->item_name = $request->item_name;
        $books->item_number =$request->item_number;
        $books->item_amount = $request->item_amount;
        $books->published = $request->published;
        $books->save();
        return redirect('/');
    }
    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'item_name' => 'required|min:3|max:255',
            'item_number' => 'required|min:1|max:3',
            'item_amount' => 'required|max:6',
            'published' => 'required|date_format:Y-m-d'
        ]);
    
        if($validator->fails()) {
            return redirect('/')
            ->withInput()
            ->withErrors($validator);
        }
    
        // Eloquentモデル(登録処理)
        $books = new Book;
        $books->item_name = $request->item_name;
        $books->item_number =$request->item_number;
        $books->item_amount = $request->item_amount;
        $books->published = $request->published;
        $books->save();
        return redirect('/');
    }

}
