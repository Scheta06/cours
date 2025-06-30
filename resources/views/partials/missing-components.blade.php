@if ($errors->any())
    <div class="message dangar-message">
        <h3>Выберите недостающие комплектующие</h3>
        <ul>
            @foreach ($errors->all() as $item)
                <li>
                    - <span>{{ $item }}</span>
                </li>
            @endforeach
        </ul>
    </div>
@endif
