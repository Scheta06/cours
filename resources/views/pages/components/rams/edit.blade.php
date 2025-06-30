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
                <i class="fas fa-microchip"></i> Редактирование данных для оперативной памяти
                {{ $data['componentInfo']->vendor->title }} {{ $data['componentInfo']->title }}
            </h1>
            @include('partials.update-component-errors')
            <div class="admin-form-container">
                <form class="product-form"
                    action="{{ route('updateItemForm', ['componentTitle' => $componentTitle, 'componentId' => $data['componentInfo']->id]) }}"
                    method="POST">
                    @method('PUT')
                    @csrf
                    <!-- Основная информация -->
                    <div class="form-section">
                        <h2 class="section-title">
                            <i class="fas fa-info-circle"></i> Основная информация
                        </h2>

                        <div class="form-grid">
                            <div class="form-group">
                                <label for="product-name">Название*</label>
                                <input type="text" id="product-name" name="title"
                                    value="{{ $data['componentInfo']->title }}" placeholder="Например, XPG Gamming D35"
                                    required>
                            </div>

                            <div class="form-group full-width">
                                <label for="product-description">Описание*</label>
                                <textarea id="product-description" rows="4" name="description" placeholder="Описание оперативной памяти..."
                                    required>{{ old('description', $data['componentInfo']->description ?? '') }}</textarea>
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
                                <label for="cpu-cores">Количество модулей*</label>
                                <input type="number" name="count_of_modules" id="cpu-cores" min="1" max="96"
                                    value="{{ $data['componentInfo']->count_of_modules }}" placeholder="2" required>
                            </div>

                            <div class="form-group">
                                <label for="cpu-cores">Тактовая частота (МГц)*</label>
                                <input type="number" name="frequency" id="cpu-cores" min="666"
                                    value="{{ $data['componentInfo']->frequency }}" placeholder="666" required>
                            </div>

                            <div class="form-group">
                                <label for="cpu-cores">Производитель*</label>
                                <select name="vendor_id" id="">
                                    <option value="">Выберите производителя</option>
                                    @foreach ($data['relations']['vendor'] as $item)
                                        <option value="{{ $item->id }}"
                                            {{ old('vendor_id', $data['componentInfo']->vendor_id) === $item->id ? 'selected' : '' }}>
                                            {{ $item->title }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="cpu-cores">Тип памяти*</label>
                                <select name="memory_type_id" id="">
                                    <option value="">Выберите тип памяти</option>
                                    @foreach ($data['relations']['memoryType'] as $item)
                                        <option value="{{ $item->id }}"
                                            {{ old('memory_type_id', $data['componentInfo']->memory_type_id) === $item->id ? 'selected' : '' }}>
                                            {{ $item->title }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="cpu-cores">Вместимость одного модуля памяти (ГБ)*</label>
                                <select name="memory_capacity_id" id="">
                                    <option value="">Выберите вместимость памяти</option>
                                    @foreach ($data['relations']['memoryCapacity'] as $item)
                                        <option value="{{ $item->id }}"
                                            {{ old('memory_capacity_id', $data['componentInfo']->memory_capacity_id) === $item->id ? 'selected' : '' }}>
                                            {{ $item->title }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <input type="hidden" value="5" name="category_id">
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
