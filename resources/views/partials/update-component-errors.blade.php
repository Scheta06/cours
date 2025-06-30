@if ($errors->any())
    <div class="message dangar-message">
        <h3>При обновлении данных о компоненте возникли ошибки</h3>
        <ul>
            @foreach($errors->all() as $item)
                <li>
                    - <span>{{ $item }}</span>
                </li>
            @endforeach
        </ul>
    </div>
@endif
