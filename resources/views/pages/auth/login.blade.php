@extends('layouts.app')

@section('content')
    <main class="main auth-page">
        <div class="container">
            <div class="auth-card">
                <h1 class="auth-title">
                    <i class="fas fa-sign-in-alt"></i> Вход в аккаунт
                </h1>

                <form class="auth-form" action="{{ route('login') }}" method="POST">
                    @csrf
                    @method('POST')
                    <div class="form-group">
                        <label for="login-email">Email</label>
                        <div class="input-with-icon">
                            <i class="fas fa-envelope"></i>
                            <input name="email" type="email" id="login-email" style="padding-left: 40px" placeholder="Ваш email" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="login-password">Пароль</label>
                        <div class="input-with-icon">
                            <i class="fas fa-lock"></i>
                            <input name="password" type="password" id="login-password" style="padding-left: 40px" placeholder="Ваш пароль" required>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block">
                        Войти
                    </button>
                    <div class="auth-footer">
                        Нет аккаунта? <a href="{{ route('registerForm') }}">Перейти к регистрации</a>
                    </div>
                </form>
            </div>
        </div>
    </main>
@endsection
