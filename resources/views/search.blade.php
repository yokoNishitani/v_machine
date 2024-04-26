@extends('layouts.product')

@section('title', '商品一覧画面')

@section('content')
<h1>商品一覧画面</h1>

<form class="form__sort" action="{{ route('products.search') }}" method="GET">
    <div>
        <input type="text" name="keyword" placeholder="検索キーワード">
        <select name="company_name" id="company_name">
            <option>メーカー名</option>
            @php
            $uniqueCompanies = $products->unique('company_id')->pluck('company.company_name');
            @endphp
            @foreach ($uniqueCompanies as $companyName)
            <option value="{{ $companyName }}">{{ $companyName }}</option>
            @endforeach
        </select>
    </div>
    <button type="submit">検索</button>
</form>

<table class="table__list">
    <tr>
        <th>ID</th>
        <th>商品画像</th>
        <th>商品名</th>
        <th>価格</th>
        <th>在庫数</th>
        <th>メーカー名</th>
        <th colspan="2">
            <button><a href="{{ route('products.add') }}">新規登録</a></button>
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
        <td><button class="list__btn--detail"><a href="{{ route('products.detail', ['id'=>$product->id]) }}
">詳細</a></button></td>
        <td>
            <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="list__btn--remove" onclick="return confirm('本当に削除しますか？')">削除</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
<script src="{{ asset('js/script.js') }}"></script>
@endsection
