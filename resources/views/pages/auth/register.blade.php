@extends('layouts.app')

@section('content')
    <main class="main auth-page">
        <div class="container">
            <div class="auth-card">
                <h1 class="auth-title">
                    <i class="fas fa-user-plus"></i> Создать аккаунт
                </h1>

                <form class="auth-form" action="{{ route('register') }}" method="POST">
                    @csrf
                    @method('POST')
                    <div class="form-group">
                        <label for="register-name">Имя</label>
                        <div class="input-with-icon">
                            <i class="fas fa-user"></i>
                            <input name="name" type="text" id="register-name" style="padding-left: 40px" placeholder="Ваше имя" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="register-email">Email</label>
                        <div class="input-with-icon">
                            <i class="fas fa-envelope"></i>
                            <input name="email" type="email" id="register-email" style="padding-left: 40px" placeholder="Ваш email" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="register-password">Пароль</label>
                        <div class="input-with-icon">
                            <i class="fas fa-lock"></i>
                            <input name="password" type="password" id="register-password" style="padding-left: 40px" placeholder="Придумайте пароль" required>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block">
                        Зарегистрироваться
                    </button>

                    <div class="auth-footer">
                        Уже есть аккаунт? <a href="{{ route('loginForm') }}">Войдите</a>
                    </div>
                </form>
            </div>
        </div>
    </main>
@endsection
