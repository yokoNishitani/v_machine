@extends('layouts.product')

@section('title', '商品一覧画面')

@section('content')
<h1>商品一覧画面</h1>
<div class="form__sort">
    <form action="">
        <input type="text" placeholder="検索キーワード">
        <select name="" id="">
            <option value="">メーカー名</option>
        </select>
    </form>
    <button>検索</button>
</div>
<table class="table__list">
    <tr>
        <th>ID</th>
        <th>商品画像</th>
        <th>商品名</th>
        <th>価格</th>
        <th>在庫数</th>
        <th>メーカー名</th>
        <th colspan="2">
            <button><a href="{{ route('product_register') }}">新規登録</a></button>
        </th>
    </tr>


@foreach ($sales as $sale)
    <tr>
        <td>{{ $sale->product_id }}.</td>
        <td>{{ $sale->product->img_path}}</td>
        <td>{{ $sale->product->product_name }}</td>
        <td>¥{{ $sale->product->price }}</td>
        <td>{{ $sale->product->stock }}</td>
        <td>{{ $sale->product->id }}</td>
        <td><button class="list__btn--detail"><a href="{{ route('product_info_detail', ['id'=>$sale->product->id]) }}
">詳細</a></button></td>
        <td><button class="list__btn--remove">削除</button></td>
    </tr>
@endforeach
</table>
<script src="{{ asset('js/script.js') }}"></script>
@endsection