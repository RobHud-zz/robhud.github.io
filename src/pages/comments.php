<?php include_once "includes/header.php" ?>

    <div class="col-0 col-md-2">
        <?php include_once "includes/menu.php" ?>
    </div>
    <div class="col-12 col-md-10">
        <?php include_once "includes/top-menu.php" ?>

        <section class="comments">
            <div class="comments__head">
                <ul class="bread-crumbs comments__crumbs">
                    <li class="bread-crumbs__item"><a href="index.php">Главная</a></li>
                    <li class="bread-crumbs__item"><a href="catalog.php">Отзывы</a></li>
                </ul>
                <div class="bamboo bamboo--no-signs">
                    <div class="bamboo__cell bamboo__cell--black comments__cell">
                        <button class="bamboo__button comments__button">написать отзыв</button>
                    </div>
                </div>
            </div>
            <div class="comments__body">


                <div class="delivery__container comments__review">
                    <div class="delivery__box comments__item">
                        <img src="img/icons/pattern_dots.png" class="delivery__dots-top">
                        <img src="img/icons/pattern_dots2.png" class="delivery__dots-bot">
                        <svg class="delivery__fish delivery__fish--1">
                            <use href="#fish-symbol"></use>
                        </svg>

                        <div class="row no-gutters">
                            <div class="col-tablet-12 delivery__grid">
                                <div class="delivery__item comments__review-inner">
                                    <p class="comments__date">30/06/2018</p>
                                    <div class="comments__img-box">
                                        <img class="comments__img" src="img/sushi.png" alt="">
                                    </div>
                                    <div class="comments__review-col">
                                        <p class="comments__user">Ольга</p>
                                        <div class="comments__card">Карта: 0651</div>
                                        <p class="comments__text">
                                            Заказываем уже не первый раз. Дети любят пиццу
                                            именно «на Диване». Всегда все аккуратно
                                            приготовлено,мясо в пицце как шашлычек очень
                                            детям нравится. Спасибо за оперативность и
                                            аккуратность.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="comments__answer">
                    <svg class="comments__answer-cat">
                        <use href="#cat"></use>
                    </svg>
                    <p class="comments__answer-text">Ольга, спасибо! К следующему заказу будем Вас ждать со Спайси роллом!!!</p>
                </div>
                <div class="delivery__container comments__review">
                    <div class="delivery__box comments__item">
                        <img src="img/icons/pattern_dots.png" class="delivery__dots-top">
                        <img src="img/icons/pattern_dots2.png" class="delivery__dots-bot">
                        <svg class="delivery__fish delivery__fish--1">
                            <use href="#fish-symbol"></use>
                        </svg>

                        <div class="row no-gutters">
                            <div class="col-tablet-12 delivery__grid">
                                <div class="delivery__item comments__review-inner">
                                    <p class="comments__date">30/06/2018</p>
                                    <div class="comments__img-box">
                                        <img class="comments__img" src="img/sushi.png" alt="">
                                    </div>
                                    <div class="comments__review-col">
                                        <p class="comments__user">Ольга</p>
                                        <div class="comments__card">Карта: 0651</div>
                                        <p class="comments__text">
                                            Заказываем уже не первый раз. Дети любят пиццу
                                            именно «на Диване». Всегда все аккуратно
                                            приготовлено,мясо в пицце как шашлычек очень
                                            детям нравится. Спасибо за оперативность и
                                            аккуратность.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="comments__answer">
                    <svg class="comments__answer-cat">
                        <use href="#cat"></use>
                    </svg>
                    <p class="comments__answer-text">Ольга, спасибо! К следующему заказу будем Вас ждать со Спайси роллом!!!</p>
                </div>
            </div>
        </section>

        <div class="pop pop--comments">
            <div class="pop__bg"></div>
            <div class="pop__inner">
                <div class="pop__cross">
                    <button class="pop__cross-in"></button>
                </div>
                <div class="pop__sym"></div>
                <p class="pop__title">ОТЗЫВ</p>
                <p class="pop__text">Поделитесь своим отзывом и получите подарок при следующем заказе</p>
                <form class="form">
                        <svg class="form__fish">
                            <use href="#fish-symbol"></use>
                        </svg>
                        <input required class="form__input" placeholder="Ваше имя">
                        <input required class="form__input" placeholder="Номер карты">
                        <input required class="form__input" type="email" placeholder="Ваш e-mail">
                        <textarea required class="form__input form__input--textarea form--no-mar" name="" id="" cols="30" rows="5" placeholder="Ваш отзыв"></textarea>
                        <div class="form__loader">
                            <div id="output" class="form__loader-img">

                            </div>
                            <div class="form__col">
                                <div class="form__file-box">
                                    <input class="form__file" id="file" type="file">
                                    <label class="form__file-view" for="file">Загрузить фото заказа</label>
                                </div>
                                <p class="form__text-s">( максимальный размер - 10 Мб)</p>
                            </div>
                        </div>
                        <div class="bamboo bamboo--no-signs">
                            <div class="bamboo__cell bamboo__cell--black">
                                <button type="button" class="bamboo__button order-trigger">отправить</button>
                            </div>
                        </div>
                </form>
            </div>
        </div>
        <div class="pop pop--success">
            <div class="pop__bg"></div>
            <div class="pop__inner">
                <div class="pop__cross">
                    <button class="pop__cross-in"></button>
                </div>
                <div class="pop__sym"></div>
                <p class="pop__title">СПАСИБО!</p>
                <p class="pop__text">Ваш отзыв опубликован. Спасибо, что поделились вашим мнением о нас</p>
                <div class="bamboo bamboo--no-signs">
                    <div class="bamboo__cell bamboo__cell--black">
                        <button type="button" class="bamboo__button order-trigger">к отзывам</button>
                    </div>
                </div>
            </div>
        </div>


        <?php include_once "includes/footer-section.php" ?>
    </div>


<?php include_once "includes/footer.php" ?>