@extends('layouts.product')

@section('title', '商品情報詳細画面')

@section('content')

<h1>商品情報詳細画面</h1>
<div class="table__detail--wrap">
    <table class="table__detail">
        <tr>
            <th>ID</th>
            <td>{{ $sale->product_id }}.</td>
        </tr>
        <tr>
            <th>商品画像</th>
            <td>{{ $sale->product->img_path }}</td>
        </tr>
        <tr>
            <th>商品名</th>
            <td>{{ $sale->product->product_name }}</td>
        </tr>
        <tr>
            <th>メーカー</th>
            <td>{{ $sale->product->company->company_name ?? 'none' }}</td>
        </tr>
        <tr>
            <th>価格</th>
            <td>{{ $sale->product->price }}</td>
        </tr>
        <tr>
            <th>在庫数</th>
            <td>{{ $sale->product->stock }}</td>
        </tr>
        <tr>
            <th>コメント</th>
            <td>{{ $sale->product->comment }}</td>
        </tr>
    </table>

    <div class="btn btn__detail">
        <button>編集</button>

        <button><a href="{{ route('product_info_list') }}">戻る</a></button>
    </div>
</div>
@endsection