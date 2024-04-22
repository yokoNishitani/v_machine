@extends('layouts.product')

@section('title', '商品情報編集画面')

@section('content')
<h1>商品情報編集画面</h1>
<form action="" class="form__update">
    <div>
        <label>ID</label>
        <input type="text" name="id" value="{{ $product->id }}.">
    </div>

    <div class="require">
        <label>商品名</label>
        <input type="text" name="product_name" value="{{ $product->product_name }}">
    </div>

    <div class="require">
        <label>メーカー名</label>
        <select name="company_name">
            <option value="{{ $product->company->company_name }}">{{ $product->company->company_name }}</option>
        </select>
    </div>

    <div class="require">
        <label>価格</label>
        <input type="text" name="price" value="¥{{ $product->price }}">
    </div>

    <div class="require">
        <label>在庫数</label>
        <input type="text" name="stock" value="{{ $product->stock }}">
    </div>

    <div>
        <label>コメント</label>
        <textarea name="comment" value="{{ $product->comment }}"></textarea>
    </div>

    <div>
        <label>商品画像</label>
        <input type="file" name="img_path" value="{{ $product->img_path }}">
    </div>

    <div class="btn btn__editor">
        <button>更新</button>

        <button><a href="{{ route('product_info_detail', ['id'=>$product->id]) }}">戻る</a></button>
    </div>

</form>
@endsection