@extends('layouts.app')

@section('title', 'ユーザーログイン画面')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <h1 class="h1__login">{{ __('ユーザーログイン画面') }}</h1>

                <div>
                    <form method="POST" action="{{ route('login') }}" class="form__login">
                        @csrf

                        <div>
                            <label for="email">{{ __('メールアドレス') }}</label>

                            <div>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

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
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <div class="btn btn__login">
                                <button>
                                    <a href="{{ route('register') }}">新規作成</a>
                                </button>

                                <button type="submit">
                                    {{ __('ログイン') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection