<!--resources/views/books.blade.php -->
@extends('layouts.app')

@section('content')
<div class="row container">
    <div class="col-md-12">
    @include('common.errors')
    <form action="{{ url('books/update') }}" method="POST">
        <div class="form-group">
            <label for="item_name">Title</label>
            <input type="text" name="item_name" class="form-control" value="{{$book->item_name}}">
        </div>
        <div class ="form-group">
            <label for="item_number">Number</label>   
            <input type="text" name="item_number" class="form-control" value="{{$book->item_number}}">
        </div>
        <div class="form-group"> 
                <label for="item_amount">Amount</label>
                <input type="text" name="item_amount" class="form-control" value="{{$book->item_amount}}">
        </div>
        <div class="form-group"> 
                <label for="published">Published</label>
                <input type="datetime" name="published" class="form-control" value="{{$book->published}}">
        </div>
        <div class="well well-sm">
                <button type="submit" class="btn btn-primary">Save</button>
                <a class="btn btn-link pull-right" href="{{url('/')}}">Back</a>
        </div>
        <input type="hidden" name="id" value="{{$book->id}}">
        @csrf
    </form>
    </div>
</div>
@endsection
