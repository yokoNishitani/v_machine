@extends('layouts.product')

@section('title', '商品情報編集画面')

@section('content')
<h1>商品情報編集画面</h1>
<form action="{{ route('products.update', $product->id) }}" class="form__update" method="POST" enctype='multipart/form-data'>
    @csrf
    @method('PUT')
    <div>
        <label>ID</label>
        <input type="text" name="id" value="{{ $product->id }}">
    </div>

    <div class="require">
        <label>商品名</label>
        <input type="text" name="product_name" value="{{ $product->product_name }}">
        @if($errors->has('product_name'))
        <p>{{ $errors->first('product_name') }}</p>
        @endif
    </div>

    <div class="require">
        <label>メーカー名</label>
        <select name="company_name">
            @foreach ($companies as $company)
            <option value="{{ $company->company_name }}" {{ $product->company->company_name == $company->company_name ? 'selected' : '' }}>
                {{ $company->company_name }}
            </option>
            @endforeach
        </select>
    </div>

    <div class="require">
        <label>価格</label>
        <input type="text" name="price" value="{{ $product->price }}">
        @if($errors->has('price'))
        <p>{{ $errors->first('price') }}</p>
        @endif
    </div>

    <div class="require">
        <label>在庫数</label>
        <input type="text" name="stock" value="{{ $product->stock }}">
        @if($errors->has('stock'))
        <p>{{ $errors->first('stock') }}</p>
        @endif
    </div>

    <div>
        <label>コメント</label>
        <textarea name="comment">{{ $product->comment }}</textarea>
        @if($errors->has('comment'))
        <p>{{ $errors->first('comment') }}</p>
        @endif
    </div>

    <div>
        <label>商品画像</label>
        <input type="file" name="images" value="{{ $product->img_path }}">
    </div>

    <div class="btn btn__editor">
        <button type="submit">更新</button>

        <button type="button">
            <a href="{{ route('products.detail', ['id'=>$product->id]) }}">戻る</a>
        </button>
    </div>
</form>
@endsection
