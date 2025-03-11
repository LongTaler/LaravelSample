<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use Validator;
use Auth;

class BooksController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index() {
        $books = Book::where('user_id', Auth::user()->id)
        ->orderBy('created_at', 'asc')
        ->paginate(3);
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
        $books = Book::where('user_id', Auth::user()->id)->find($request->id);
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
        $file = $request->file('item_img');
        if(!empty($file) ){
            $filename = $file->getClientOriginalName();
            $move = $file->move(public_path('upload'), $filename);

        }else{
            $filname = "";
        }
    
        // Eloquentモデル(登録処理)
        $books = new Book;
        $books->user_id = Auth::user()->id;
        $books->item_name = $request->item_name;
        $books->item_number =$request->item_number;
        $books->item_amount = $request->item_amount;
        $books->item_img =$filename;
        $books->published = $request->published;
        $books->save();
        return redirect('/')->with('message','本登録が完了しました');
    }
    public function edit($book_id) {
        $books = Book::where('user_id',Auth::user()->id)->find($book_id);
        return view('booksedit',[
            'book' => $books
        ]);
    }


    public function destroy(Book $book){
        $book->delete();
        return redirect('/');
    }
}
