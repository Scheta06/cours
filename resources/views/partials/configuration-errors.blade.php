<div class="compatibility-errors">
    <h3><i class="fas fa-exclamation-triangle"></i> Проверка совместимости</h3>
    <div class="errors-list">
        @if ($configurationErrors)
            @foreach ($configurationErrors as $item)
                <div class="error-item">
                    <i class="fas fa-exclamation-circle"></i>
                    <span>{{ $item }}</span>
                </div>
            @endforeach
        @else
            <div class="no-errors">
                <i class="fas fa-check"></i>
                <span>Все компоненты совместимы</span>
            </div>
        @endif
    </div>
</div>
