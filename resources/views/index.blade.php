@extends('layouts.product')

@section('title', '商品一覧画面')

@section('content')
<h1>商品一覧画面</h1>
<div class="form__sort">
    <form action="">
        <input type="text" placeholder="検索キーワード">
        <select name="" id="">
            <option value="メーカー名">メーカー名</option>
            @foreach ($products as $product)
            <option value="{{ $product->company->id }}">{{ $product->company->company_name }}</option>
            @endforeach
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
            <button><a href="{{ route('add') }}">新規登録</a></button>
        </th>
    </tr>

    @foreach ($products as $product)
    <tr>
        <td>{{ $product->id }}.</td>
        <td>{{ $product->img_path}}</td>
        <td>{{ $product->product_name }}</td>
        <td>¥{{ $product->price }}</td>
        <td>{{ $product->stock }}</td>
        <td>{{ $product->company->company_name }}</td>
        <td><button class="list__btn--detail"><a href="{{ route('product_info_detail', ['id'=>$product->id]) }}
">詳細</a></button></td>
        <td><button class="list__btn--remove">削除</button></td>
    </tr>
    @endforeach
</table>
<script src="{{ asset('js/script.js') }}"></script>
@endsection