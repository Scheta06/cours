@extends('layouts.app')

@section('content')
    @if (session('success'))
        <div class="notifications-container" id="notifications">
            
        </div>
    @endif
    <main class="main admin-panel">
        <div class="container">
            <!-- Хлебные крошки -->
            <div class="breadcrumbs">
                <a href="{{ route('index') }}">Главная</a>
                <i class="fas fa-chevron-right"></i>
                <a href="{{ route('profile') }}">Профиль</a>
                <i class="fas fa-chevron-right"></i>
                <span>Админ-панель</span>
            </div>

            <h1 class="page-title">
                <i class="fas fa-user-shield"></i> Админ-панель
            </h1>

            <div class="admin-grid">
                <!-- Карточка управления товарами -->
                <div class="admin-card">
                    <div class="admin-card-icon">
                        <i class="fas fa-boxes"></i>
                    </div>
                    <h3>Управление товарами</h3>
                    <p>Редактирование, удаление и организация товаров в каталоге</p>
                    <a href="{{ route('manageItemForm') }}" class="btn btn-primary">
                        <i class="fas fa-arrow-right"></i> Перейти
                    </a>
                </div>

                <!-- Карточка создания товара -->
                <div class="admin-card">
                    <div class="admin-card-icon">
                        <i class="fas fa-plus-square"></i>
                    </div>
                    <h3>Создать товар</h3>
                    <p>Добавление нового товара в каталог</p>
                    <a href="{{ route('categoryOfCreateItemForm') }}" class="btn btn-primary">
                        <i class="fas fa-arrow-right"></i> Перейти
                    </a>
                </div>

            </div>

            <!-- Быстрая статистика -->
            <div class="admin-stats">
                <h2 class="section-title">
                    <i class="fas fa-chart-line"></i> Статистика
                </h2>
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-value">{{ $productCount }}</div>
                        <div class="stat-label">Товаров в каталоге</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-value">{{ $userCount }}</div>
                        <div class="stat-label">Зарегистрированных пользователей</div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
