<!--resources/views/books.blade.php -->
@extends('layouts.app')

@section('content')
<div class="card-body">
    <div class="card-title">
        本のタイトル
    </div>

    @include('common.errors')
    <form enctype="multipart/form-data" action="{{ url('books') }}" method="POST" class="form-horizontal">
        @csrf
        <div class="form-row">
            <div class="form-group col-md-6"> 
                <label for="book" class="col-sm-3 control-label">Book</label>
                <input type="text" name="item_name" class="form-control">
            </div>
            <div class ="form-group col-md-6">
                <label for="amount" class="col-sm-3 contrpl-label">金額 </label>   
                <input type="text" name="item_amount" class="form-control">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6"> 
                <label for="number" class="col-sm-3 control-label">数</label>
                <input type="text" name="item_number" class="form-control">
            </div>
            <div class ="form-group col-md-6">
                <label for="published" class="col-sm-3 contrpl-label">公開日 </label>   
                <input type="date" name="published" class="form-control">
            </div>
        </div>
        <div class="col-sm-6">
            <label>画像</label>
            <input type="file" name="item_img">
        </div>
        <div class="form-row">
            <div class="col-sm-offset-3 col-sm-6">
                <button type="submit" class="btn btn-primary">
                    Save
                </button>
            </div>
        </div>
    </form>
</div>
@if(session('message'))
    <div class="alert alert-success">
        {{session('message')}}
    </div>
@endif
@if(count($books) > 0)
    <div class ="card-body">
        <div class ="card-body">
            <table class = "table table--striped task-table">
                <thead>
                    <th>本一覧</th>
                    <th>&nbsp;</th>
                </thead>
                <tbody>
                @foreach($books as $book)
                    <tr>
                        <td class="table-text">
                            <div>{{ $book->item_name }}</div>
                            <div><img src="upload/{{$book->item_img}}"width="100"></div>
                        </td>
                        <td>
                            <form action="{{ url('booksedit/'.$book->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary">更新</button>
                            </form>  <!-- 閉じタグを追加 -->
                        </td>
                        <td>
                            <form action="{{ url('book/'.$book->id) }}" method="POST">
                                @csrf  <!-- CSRFトークンが必要 -->
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">削除</button>
                            </form>  <!-- 閉じタグを追加 -->
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 offset-md-4">
        {{$books->links('pagination::bootstrap-4')}}
        </div>
    </div>
@endif
@endsection
