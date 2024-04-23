@extends('layouts.product')

@section('title', '商品新規登録画面')

@section('content')
<h1 class="h1__regist">商品新規登録画面</h1>

<form action="{{ route('create') }}" method="post" class="form__product-regist" enctype='multipart/form-data'>
    @csrf

    <div class="require">
        <label>商品名</label>
        <input type="text" name="product_name" id="product_name" value="{{ old('product_name') }}">
        @if($errors->has('product_name'))
        <p>{{ $errors->first('product_name') }}</p>
        @endif
    </div>

    <div class="require">
        <label>メーカー名</label>
        <select name="company_name" id="company_name">
            @foreach ($companies as $company)
            <option value="{{ $company->company_name }}" {{ old('company_name') == $company->id ? 'selected' : '' }}>
                {{ $company->company_name }}
            </option>
            @endforeach
        </select>
    </div>

    <div class="require">
        <label>価格</label>
        <input type="text" name="price" id="price" value="{{ old('price') }}">
        @if($errors->has('price'))
        <p>{{ $errors->first('price') }}</p>
        @endif
    </div>

    <div class="require">
        <label>在庫数</label>
        <input type="text" name="stock" id="stock" value="{{ old('stock') }}">
        @if($errors->has('stock'))
        <p>{{ $errors->first('stock') }}</p>
        @endif
    </div>

    <div>
        <label>コメント</label>
        <textarea name="comment" id="comment">{{ old('comment') }}</textarea>
        @if($errors->has('comment'))
        <p>{{ $errors->first('comment') }}</p>
        @endif
    </div>

    <div>
        <label>商品画像</label>
        <input type="file" name="img_url" id="img_url" value="{{ old('img_url') }}">
    </div>

    <div class=" btn btn__regist">
        <button type="submit">新規登録</button>

        <button type="button"><a href="{{ route('list') }}">戻る</a></button>
    </div>

</form>


@endsection