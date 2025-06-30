@extends('layouts.app')

@section('content')
    <main class="main admin-page">
        <div class="container">

            <!-- Хлебные крошки -->
            <div class="breadcrumbs">
                <a href="{{ route('index') }}">Главная</a>
                <i class="fas fa-chevron-right"></i>
                <a href="{{ route('profile') }}">Профиль</a>
                <i class="fas fa-chevron-right"></i>
                <a href="{{ route('adminPanelForm') }}">Админ-панель</a>
                <i class="fas fa-chevron-right"></i>
                <span>Создать товар</span>
            </div>

            <h1 class="page-title">
                <i class="fas fa-plus-circle"></i> Создание нового товара
            </h1>

            @include('partials.notification')

            <div class="admin-form-container">

                <div class="form-step active" id="step-category">
                    <h2 class="step-title">
                        Выберите категорию
                    </h2>

                    <div class="category-grid">
                        @foreach ($categoryInfo as $key => $value)
                            <a href="{{ route('createItemForm', ['componentTitle' => $key]) }}" class="category-card">
                                <input type="radio" name="category" value="cpu" required>
                                <div class="category-content">
                                    <div class="category-icon">
                                        <i class="{{ $value['icon'] }}"></i>
                                    </div>
                                    <h3>{{ $value['title'] }}</h3>
                                    <p>{{ $value['subtitle'] }}</p>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>


            </div>
        </div>
    </main>
@endsection
