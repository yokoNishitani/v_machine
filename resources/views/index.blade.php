@extends('layouts.product')

@section('title', '商品一覧画面')

@section('content')
<h1>商品一覧画面</h1>

<form id="search-form" class="form__sort">
    <div>
        <div class="form__sort--row">
            <input type="text" id="keyword" name="keyword" placeholder="検索キーワード">
            <select name="company_name" id="company_name">
                <option value="">メーカー名</option>
                @php
                $uniqueCompanies = $products->unique('company_id')->pluck('company.company_name');
                @endphp
                @foreach ($uniqueCompanies as $companyName)
                <option value="{{ $companyName }}">{{ $companyName }}</option>
                @endforeach
            </select>
        </div>
        <div class="form__sort--row">
            <div>
                <input type="number" id="price_min" name="price_min" placeholder="価格の下限">
                <input type="number" id="price_max" name="price_max" placeholder="価格の上限">
            </div>
            <div>
                <input type="number" id="stock_min" name="stock_min" placeholder="在庫数の下限">
                <input type="number" id="stock_max" name="stock_max" placeholder="在庫数の上限">
            </div>
        </div>
    </div>
    <button type="button" id="search-button" data-search-url="{{ route('products.search') }}">検索</button>
</form>


<table class="table__list">
    <thead>
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
    </thead>
    <tbody id="product-list">
        @foreach ($products as $product)
        <tr>
            <td>{{ $product->id }}</td>
            <td>@if ($product->img_path)
                <img src="{{ asset($product->img_path) }}" alt="Image" width="30" height="auto">
                @endif
            </td>
            <td>{{ $product->product_name }}</td>
            <td>¥{{ $product->price }}</td>
            <td>{{ $product->stock }}</td>
            <td>{{ $product->company->company_name }}</td>
            <td>
                <button class="list__btn--detail" type="button">
                    <a href="{{ route('products.detail', ['id'=>$product->id]) }}">詳細</a>
                </button>

            </td>
            <td>
                <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="list__btn--remove" onclick="return confirm('本当に削除しますか？')">削除</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    var assetBaseUrl = "{{ asset('') }}";
    var searchUrl = "{{ route('products.search') }}";
    var detailUrlBase = "{{ route('products.detail', ['id' => ':id']) }}";
    var destroyUrlBase = "{{ route('products.destroy', ['id' => ':id']) }}";
    var csrfToken = '{{ csrf_token() }}';
</script>
<script src="{{ asset('js/script.js') }}"></script>
@endsection