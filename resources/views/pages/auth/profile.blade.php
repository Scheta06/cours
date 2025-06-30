@extends('layouts.app')

@section('content')
    <main class="main profile-page">
        <div class="container">
            <div class="profile-card">
                <div class="profile-header">
                    <img src="https://via.placeholder.com/120" class="avatar">
                    <div class="user-info">
                        <h1 class="user-name">{{ $user->name }}</h1>
                        @if ($user->role === 'user')
                            <span class="user-role" id="userRoleBadge">
                                <i class="fas fa-user"></i> Пользователь
                            </span>
                        @else
                            <span class="user-role" id="userRoleBadge">
                                <i class="fas fa-user"></i> Администратор
                            </span>
                        @endif
                        <div class="user-stats">
                            <div class="stat-item">
                                <div class="stat-value">{{ $configurationCount }}</div>
                                <div class="stat-label">Сборок</div>
                            </div>
                        </div>
                    </div>
                    <div class="profile-actions">
                        <!-- Эта кнопка будет видна только админам -->
                        @if ($user->role === 'admin')
                            <a href="{{ route('adminPanelForm') }}" class="btn btn-primary admin-only" id="adminPanelBtn">
                                <i class="fas fa-user-cog"></i> Админ-панель
                            </a>
                        @endif
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button class="btn btn-outline">
                                <i class="fas fa-sign-out"></i> Выйти из аккаунта
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="profile-card">
                <h2 class="section-title">
                    <i class="fas fa-info-circle"></i> Информация
                </h2>
                <div class="info-grid">
                    <div class="info-item">
                        <span class="info-label">Email</span>
                        <div class="info-value">{{ $user->email }}</div>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Дата регистрации</span>
                        <div class="info-value">{{ $user->created_at }}</div>
                    </div>
                </div>
            </div>

            <div class="profile-card">
                <h2 class="section-title">
                    <i class="fas fa-tools"></i> Последние сборки
                </h2>
                @if ($configurationCount === 0)
                    <div class="empty-state">
                        <i class="fas fa-tools"></i>
                        <p>У вас пока нет сборок</p>
                        <a href="{{ route('index') }}" class="btn btn-primary" style="margin-top:5px;">Создать сборку</a>
                    </div>
                @else
                    @foreach ($userConfigurations as $key => $value)
                        <div class="builds-container">
                            <div class="build-card">
                                <div class="build-header">
                                    <h3 class="build-title">{{ $value->title }}</h3>
                                    <div class="build-actions">
                                        <form action="{{ route('deleteConfiguration', ['configurationId' => $value->id]) }}"
                                            method="POST" class="build-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline btn-sm">
                                                <i class="fas fa-trash"></i> Удалить
                                            </button>
                                        </form>
                                    </div>
                                </div>
                                <p class="build-description">{{ $value->description }}</p>

                                <div class="components-list">
                                    <div class="component-item">
                                        <span class="component-label">Процессор</span>
                                        <span class="component-value">{{ $value->processor->vendor->title }}
                                            {{ $value->processor->title }}</span>
                                    </div>

                                    <div class="component-item">
                                        <span class="component-label">Материнская плата</span>
                                        <span class="component-value">{{ $value->motherboard->vendor->title }}
                                            {{ $value->motherboard->chipset->title }}
                                            {{ $value->motherboard->title }}</span>
                                    </div>

                                    <div class="component-item">
                                        <span class="component-label">Кулер</span>
                                        <span class="component-value">{{ $value->cooler->vendor->title }}
                                            {{ $value->cooler->title }}</span>
                                    </div>

                                    <div class="component-item">
                                        <span class="component-label">Накопитель</span>
                                        <span class="component-value">{{ $value->storage->vendor->title }}
                                            {{ $value->storage->title }}</span>
                                    </div>

                                    <div class="component-item">
                                        <span class="component-label">Видеокарта</span>
                                        <span class="component-value">{{ $value->videocard->vendor->title }}
                                            {{ $value->videocard->title }}</span>
                                    </div>

                                    <div class="component-item">
                                        <span class="component-label">Блок питания</span>
                                        <span class="component-value">{{ $value->psu->vendor->title }}
                                            {{ $value->psu->title }}</span>
                                    </div>

                                    <div class="component-item">
                                        <span class="component-label">Корпус</span>
                                        <span class="component-value">{{ $value->chassis->vendor->title }}
                                            {{ $value->chassis->title }}</span>
                                    </div>
                                </div>
                                @include(
                                    'partials.configuration-errors',
                                    $configurationErrors = $value->errors)
                            </div>
                        </div>
                    @endforeach
            </div>
            @endif
        </div>
    </main>
@endsection
