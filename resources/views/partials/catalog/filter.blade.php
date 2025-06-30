<aside class="catalog-filters">
    <div class="filter-group">
        <h3 class="filter-title">
            <i class="fas fa-filter"></i> Фильтры
        </h3>
        <form action="{{ route('catalog', ['componentTitle' => $componentTitle]) }}">
            <div class="filter-section">
                <h4>Производитель</h4>
                <select name="vendor" id="" class="btn btn-filter select-component">
                    <option value="">Выберите производителя</option>
                    @foreach ($vendors as $vendor)
                        <option value="{{ $vendor->id }}" {{ old('vendor_id', $vendor->id) }}>{{ $vendor->title }}
                        </option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Применить</button>
        </form>

    </div>
</aside>
