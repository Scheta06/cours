@extends('layouts.app')

@section('content')
    <main class="main auth-page">
        <div class="container">
            <div class="auth-card">
                <h1 class="auth-title">
                    <i class="fas fa-cog"></i> Изменить пароль
                </h1>

                <form class="auth-form" action="{{ route('login') }}" method="POST">
                    @csrf
                    @method('POST')
                    <div class="form-group">
                        <label for="login-email">Текущий пароль</label>
                        <div class="input-with-icon">
                            <i class="fas fa-envelope"></i>
                            <input name="current_password" type="password" placeholder="Ваш текущий пароль" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="login-password">Новый пароль</label>
                        <div class="input-with-icon">
                            <i class="fas fa-lock"></i>
                            <input name="new_password" type="password" placeholder="Ваш новый пароль" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="login-password">Повтор нового пароля</label>
                        <div class="input-with-icon">
                            <i class="fas fa-lock"></i>
                            <input name="password" type="password" placeholder="Ваш новый пароль" required>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block">
                        Войти
                    </button>
                    <div class="auth-footer">
                        Вернуться в профиль? <a href="{{ route('profile') }}">Профиль</a>
                    </div>
                </form>
            </div>
        </div>
    </main>
@endsection
