@extends('layouts.product')

@section('title', '商品情報詳細画面')

@section('content')

<h1>商品情報詳細画面</h1>
<div class="table__detail--wrap">
    <table class="table__detail">
        <tr>
            <th>ID</th>
            <td>{{ $product->id }}.</td>
        </tr>
        <tr>
            <th>商品画像</th>
            <td>{{ $product->img_path }}</td>
        </tr>
        <tr>
            <th>商品名</th>
            <td>{{ $product->product_name }}</td>
        </tr>
        <tr>
            <th>メーカー</th>
            <td>{{ $product->company->company_name }}</td>
        </tr>
        <tr>
            <th>価格</th>
            <td>¥{{ $product->price }}</td>
        </tr>
        <tr>
            <th>在庫数</th>
            <td>{{ $product->stock }}</td>
        </tr>
        <tr>
            <th>コメント</th>
            <td>{{ $product->comment }}</td>
        </tr>
    </table>

    <div class="btn btn__detail">
        <button><a href="{{ route('products.edit', ['id'=>$product->id]) }}">編集</a></button>

        <button><a href="{{ route('list') }}">戻る</a></button>
    </div>
</div>
@endsection