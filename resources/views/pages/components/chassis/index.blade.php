@extends('layouts.catalog')

@section('content')
    <!-- Основной контент -->
    <main class="main catalog-page">
        <div class="container">
            <!-- Хлебные крошки -->
            <div class="breadcrumbs">
                <a href="{{ route('index') }}">Главная</a>
                <i class="fas fa-chevron-right"></i>
                <span>{{ $title }}</span>
            </div>

            <!-- Заголовок и фильтры -->
            @include('partials.catalog.search')

            <div class="catalog-layout">
                <!-- Боковые фильтры -->
                @include('partials.catalog.filter')
                @if ($data->count() != 0)
                    <!-- Основной контент каталога -->
                    <div class="catalog-content">
                        <div class="products-grid">
                            @foreach ($data as $item)
                                {{-- Товар --}}
                                <div class="product-card">

                                    <div class="product-image">
                                        <img src="https://via.placeholder.com/300x300" alt="" loading="lazy">
                                    </div>

                                    <div class="product-info">
                                        <h3 class="product-title">{{ $item->vendor->title }} {{ $item->title }}</h3>

                                        <div class="product-specs">
                                            <div class="spec-item">
                                                <i class="fas fa-microchip"></i>
                                                <span>Форм-фактор - {{ $item->form->title }}</span>
                                            </div>
                                        </div>

                                        <div class="product-actions">
                                            <a href="{{ route('component', ['componentTitle' => $componentTitle, 'componentId' => $item->id]) }}"
                                                class="btn btn-outline btn-sm">
                                                <i class="fas fa-info-circle"></i> Подробнее
                                            </a>
                                            <form
                                                action="{{ route('storeComponent', ['componentTitle' => $componentTitle, 'componentId' => $item->id]) }}"
                                                method="POST">
                                                @csrf
                                                @method('POST')
                                                @csrf
                                                <button class="btn btn-primary btn-sm add-to-build">
                                                    <i class="fas fa-plus"></i> В сборку
                                                </button>
                                            </form>
                                        </div>
                                    </div>

                                </div>
                            @endforeach
                        </div>
                        <div class="pagination-wrapper">
                            {{ $data->links('partials.pagination') }}
                        </div>
                    </div>
                @else
                    @include('partials.no-data')
                @endif
            </div>
    </main>
@endsection
