<section class="conf-step">
    <header class="conf-step__header conf-step__header_opened">
        <h2 class="conf-step__title">Управление залами</h2>
    </header>
    <div class="conf-step__wrapper">
        <p class="conf-step__paragraph">Доступные залы:</p>

        <ul class="conf-step__list">
            <!-- Отображение всех залов из таблицы -->
            @foreach($halls as $hall)
                <li>
                    <form action="/delete-hall/{{ $hall->id }}" method="POST">
                        {{$hall->name}}
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="conf-step__button conf-step__button-trash"></button>
                    </form>
                </li>
            @endforeach
        </ul>
        <!-- форма для отправки запроса на создания зала в таблице залов медотом post -->
        <form action="/create-hall" method="POST">
            @csrf
            <button type='submit' class="conf-step__button conf-step__button-accent">Создать зал</button>
        </form>
    </div>
</section>