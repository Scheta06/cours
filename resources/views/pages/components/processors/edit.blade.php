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
                <a href="{{ route('manageItemForm') }}">Управление товарами</a>
                <i class="fas fa-chevron-right"></i>
                <span>Редактирование данных</span>
            </div>
            <h1 class="page-title">
                <i class="fas fa-microchip"></i> Редактирование данных для процессора {{ $data['componentInfo']->vendor->title }}
                {{ $data['componentInfo']->title }}
            </h1>
            <div class="admin-form-container">
                <form class="product-form"
                    action="{{ route('updateItemForm', ['componentTitle' => $componentTitle, 'componentId' => $componentId]) }}"
                    method="POST">
                    @csrf
                    @method('PUT')
                    <!-- Основная информация -->
                    <div class="form-section">
                        <h2 class="section-title">
                            <i class="fas fa-info-circle"></i> Основная информация
                        </h2>
                        <div class="form-grid">
                            <div class="form-group">
                                <label for="product-name">Название*</label>
                                <input type="text" id="product-name" name="title"
                                    value="{{ $data['componentInfo']->title }}" placeholder="Например, Ryzen 5 5600X"
                                    value="" required>
                            </div>

                            <div class="form-group full-width">
                                <label for="product-description">Описание*</label>
                                <textarea id="product-description" rows="4" name="description" placeholder="Описание процессора..." required>{{ old('description', $data['componentInfo']->description ?? '') }}</textarea>
                            </div>
                        </div>
                    </div>
                    <!-- Технические характеристики -->
                    <div class="form-section">
                        <h2 class="section-title">
                            <i class="fas fa-cogs"></i> Технические характеристики
                        </h2>
                        <div class="form-grid">
                            <div class="form-group">
                                <label for="cpu-cores">Производитель*</label>
                                <select name="vendor_id" class="form-control">
                                    <option value="">Выберите производителя</option>
                                    @foreach ($data['relations']['vendor'] as $item)
                                        <option value="{{ $item->id }}"
                                            {{ old('vendor_id', $data['componentInfo']->vendor_id) == $item->id ? 'selected' : '' }}>
                                            {{ $item->title }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="cpu-cores">Сокет*</label>
                                <select name="socket_id" id="">
                                    <option value="">Выберите сокет</option>
                                    @foreach ($data['relations']['socket'] as $item)
                                        <option value="{{ $item->id }}"
                                            {{ old('socket_id', $data['componentInfo']->socket_id) == $item->id ? 'selected' : '' }}>
                                            {{ $item->title }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="cpu-cores">Количество ядер*</label>
                                <input type="number" name="count_of_cores"
                                    value="{{ $data['componentInfo']->count_of_cores }}" id="cpu-cores" min="1"
                                    max="96" placeholder="6" required>
                            </div>

                            <div class="form-group">
                                <label for="cpu-threads">Количество потоков*</label>
                                <input type="number" id="cpu-threads" min="1" max="128" placeholder="12"
                                    name="count_of_streams" value="{{ $data['componentInfo']->count_of_streams }}"
                                    required>
                            </div>

                            <div class="form-group">
                                <label for="cpu-base-freq">Базовая частота (ГГц)*</label>
                                <input type="number" id="cpu-base-freq" step="0.1" min="0.5" max="6.0"
                                    name="base_frequency" value="{{ $data['componentInfo']->base_frequency }}"
                                    placeholder="3.7" required>
                            </div>

                            <div class="form-group">
                                <label for="cpu-max-freq">Макс. частота (ГГц)</label>
                                <input type="number" id="cpu-max-freq" step="0.1" min="0.5" max="6.0"
                                    name="max_frequency" value="{{ $data['componentInfo']->max_frequency }}"
                                    placeholder="4.6">
                            </div>

                            <div class="form-group">
                                <label for="cpu-tdp">TDP (Вт)</label>
                                <input type="number" id="cpu-tdp" min="10" name="tdp"
                                    value="{{ $data['componentInfo']->tdp }}" max="300" placeholder="65">
                            </div>

                            <input type="hidden" value="1" name="category_id">
                        </div>
                    </div>

                    <!-- Кнопки отправки -->
                    <div class="form-actions">

                        <a href="{{ route('manageItemForm') }}" type="button" class="btn btn-outline">
                            <i class="fas fa-times"></i> Отменить
                        </a>
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-save"></i> Изменить
                        </button>

                    </div>
                </form>
            </div>
        </div>
    </main>
@endsection
