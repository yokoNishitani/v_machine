@extends('layouts.app')

@section('title', 'ユーザー新規登録画面')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1 class="h1__register">{{ __('ユーザー新規登録画面') }}</h1>

            <form method="POST" action="{{ route('register') }}" class="form__user">
                @csrf

                <div>
                    <label for="name">{{ __('ユーザーネーム') }}</label>

                    <div>
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="email">{{ __('メールアドレス') }}</label>

                    <div>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="password">{{ __('パスワード') }}</label>

                    <div>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="password-confirm">{{ __('パスワード(確認用)') }}</label>

                    <div>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    </div>
                </div>

                <div class="btn btn__register">
                    <button type="submit">
                        {{ __('新規登録') }}
                    </button>

                    <button type="button">
                        <a href="{{ route('login') }}">戻る</a>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection