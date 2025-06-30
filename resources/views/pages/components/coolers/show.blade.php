@extends('layouts.app')

@section('content')
    <main class="main product-page">
        <div class="container">
            <!-- Хлебные крошки -->
            <div class="breadcrumbs">
                <a href="{{ route('index') }}">Главная</a>
                <i class="fas fa-chevron-right"></i>
                <a href="{{ route('catalog', ['componentTitle' => $componentTitle]) }}">Кулеры</a>
                <i class="fas fa-chevron-right"></i>
                <span>Кулер {{ $data->vendor->title }} {{ $data->title }}</span>
            </div>

            <!-- Основная карточка товара -->
            <div class="product-card detailed">
                <div class="product-gallery">
                    <div class="main-image">
                        <img src="https://via.placeholder.com/600x600" alt="{{ $data->vendor->title }} {{ $data->title }}"
                            loading="lazy">
                    </div>
                </div>

                <div class="product-details">
                    <div class="product-header">
                        <h1 class="product-title">Кулер {{ $data->vendor->title }} {{ $data->title }}</h1>
                    </div>

                    <div class="product-actions">
                        <form
                            action="{{ route('storeComponent', ['componentTitle' => $componentTitle, 'componentId' => $data->id]) }}"
                            method="POST">
                            @csrf
                            @method('POST')
                            <button type="submit" class="btn btn-primary btn-lg full-height full-width">
                                <i class="fas fa-shopping-cart"></i> Добавить в конфигурацию
                            </button>
                        </form>
                        <a href="{{ route('catalog', ['componentTitle' => $componentTitle]) }}"
                            class="btn btn-outline btn-lg">
                            <i class="fas fa-heart"></i> Вернуться к каталогу
                        </a>
                    </div>

                </div>
            </div>

            <!-- Характеристики -->
            <div class="product-specs">
                <h2 class="section-title">
                    <i class="fas fa-list-alt"></i> Характеристики
                </h2>
                <div class="specs-grid">
                    <div class="spec-row">
                        <span class="spec-name">Производитель</span>
                        <span class="spec-value">{{ $data->vendor->title }}</span>
                    </div>
                    <div class="spec-row">
                        <span class="spec-name">Название</span>
                        <span class="spec-value">{{ $data->title }}</span>
                    </div>
                    <div class="spec-row">
                        <span class="spec-name">Мощность (Вт)</span>
                        <span class="spec-value">{{ $data->power }}</span>
                    </div>
                </div>

                <!-- Описание -->
                <div class="product-full-description">
                    <h2 class="section-title">
                        <i class="fas fa-align-left"></i> Описание
                    </h2>
                    <div class="description-content">
                        <p>{{ $data->description }}
                        </p>
                    </div>
                </div>
        </div @endsection
