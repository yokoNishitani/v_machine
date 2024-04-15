@extends('layouts.product')

@section('title', '商品情報編集画面')

@section('content')
<h1>商品情報編集画面</h1>
<form action="" class="form__editor">
    <div class="require">
        <label>ID</label>
        <input type="text" name="id" value="">
    </div>

    <div class="require">
        <label>商品名</label>
        <input type="text" name="product_name" value="">
    </div>

    <div class="require">
        <label>メーカー名</label>
        <select name="company_name">
            <option value="1"></option>
        </select>
    </div>

    <div class="require">
        <label>価格</label>
        <input type="text" name="price" value="">
    </div>

    <div>
        <label>在庫数</label>
        <input type="text" name="stock" value="">
    </div>

    <div>
        <label>コメント</label>
        <textarea name="comment" value=""></textarea>
    </div>

    <div>
        <label>商品画像</label>
        <input type="file" name="img_path" value="">
    </div>

    <div class="btn btn__editor">
        <button>更新</button>

        <button><a href="{{ route('product_info_detail') }}">戻る</a></button>
    </div>

</form>
@endsection