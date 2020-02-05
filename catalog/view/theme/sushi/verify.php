<?php include_once "includes/header.php" ?>

    <div class="col-0 col-md-2">
        <?php include_once "includes/menu.php" ?>
    </div>
    <div class="col-12 col-md-10">
        <?php include_once "includes/top-menu.php" ?>

        <div class="order order-form">
            <div class="order__nav">
                <ul class="bread-crumbs">
                    <li class="bread-crumbs__item"><a href="index.php">Главная</a></li>
                    <li class="bread-crumbs__item"><a href="catalog.php">Роллы</a></li>
                    <li class="bread-crumbs__item"><a href="product-card.php">Филадельфия классик</a></li>
                    <li class="bread-crumbs__item"><a href="product-card.php">Корзина</a></li>
                </ul>

                <div class="counter">
                    <div class="counter__circle">1</div>
                    <div class="counter__circle">2</div>
                    <div class="counter__circle">3</div>
                </div>
            </div>
            <div class="order__inner">
                <div class="form-section">
                    <div class="title"><h2 class="title__text">ОФОРМЛЕНИЕ ЗАКАЗА<span class="title__tr">ショッピングカート</span></h2></div>
                    <form class="form">
                        <div class="form__inner">
                            <svg class="form__fish">
                                <use href="#fish-symbol"></use>
                            </svg>
                            <input class="form__input" placeholder="Ваше имя">
                            <input class="form__input" placeholder="Телефон">
                            <input class="form__input" placeholder="Адрес доставки">
                            <p class="form__text">способ оплаты:</p>
                            <div class="form__row">
                                <div class="form__radio-box">
                                    <input class="form__radio" id="form-rad-1" type="radio" name="form-radio" placeholder="Наличные">
                                    <label class="form__input form__input--radio" for="form-rad-1">Наличными</label>
                                </div>
                                <div class="form__radio-box">
                                    <input class="form__radio" id="form-rad-2" type="radio" name="form-radio" placeholder="Онлайн">
                                    <label class="form__input form__input--radio" for="form-rad-2">Онлайн</label>
                                </div>
                            </div>
                            <textarea class="form__input form__input--textarea" name="" id="" cols="30" rows="5" placeholder="Комментарий"></textarea>
                            <div class="bamboo bamboo--no-signs">
                                <div class="bamboo__cell bamboo__cell--black">
                                    <button type="button" class="bamboo__button order-trigger">ОФОРМИТЬ ЗАКАЗ</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="result-section">
                    <div class="delivery__container">
                        <div class="delivery__box">
                            <img src="img/icons/pattern_dots.png" class="delivery__dots-top">
                            <img src="img/icons/pattern_dots2.png" class="delivery__dots-bot">
                            <svg class="delivery__fish delivery__fish--1">
                                <use href="#fish-symbol"></use>
                            </svg>
                            <svg class="delivery__fish delivery__fish--2">
                                <use href="#fish-symbol"></use>
                            </svg>

                            <div class="row no-gutters">
                                <div class="col-tablet-12 delivery__grid">
                                    <div class="delivery__item delivery__item--syms sum__inner">
                                        <p class="delivery__text-big">СПАСИБО!</p>
                                        <p class="delivery__text">Ваш заказ принят, ожидайте звонка от нашего оператора</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php include_once "includes/footer-section.php" ?>
    </div>


<?php include_once "includes/footer.php" ?>