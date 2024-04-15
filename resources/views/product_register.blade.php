@extends('layouts.product')

@section('title', '商品新規登録画面')

@section('content')
<h1 class="h1__register">商品新規登録画面</h1>

<form action="{{ route('regist_submit') }}" method="post" class="form__product-register">
    @csrf

    <div class="require">
        <label>商品名</label>
        <input type="text" name="product_name" value="{{ old('product_name') }}">
        @if($errors->has('product_name'))
        <p>{{ $errors->first('product_name') }}</p>
        @endif
    </div>

    <div class="require">
        <label>メーカー名</label>
        <select name="company_name" value="{{ old('company_name') }}">
            @foreach ($companies as $company)
            <option>{{ $company->company_name }}</option>
            @endforeach
        </select>
    </div>

    <div class="require">
        <label>価格</label>
        <input type="text" name="price" value="{{ old('price') }}">
        @if($errors->has('price'))
        <p>{{ $errors->first('price') }}</p>
        @endif
    </div>

    <div class="require">
        <label>在庫数</label>
        <input type="text" name="stock" value="{{ old('stock') }}">
        @if($errors->has('stock'))
        <p>{{ $errors->first('stock') }}</p>
        @endif
    </div>

    <div>
        <label>コメント</label>
        <textarea name="comment">{{ old('comment') }}</textarea>
    </div>

    <div>
        <label>商品画像</label>
        <input type="file" name="img_path" value="{{ old('img_path') }}">
    </div>

    <div class=" btn btn__register">
        <button type="submit">新規登録</button>

        <button><a href="{{ route('product_info_list') }}">戻る</a></button>
    </div>
</form>

@endsection