<?php include_once "includes/header.php" ?>

    <div class="col-0 col-md-2">
        <?php include_once "includes/menu.php" ?>
    </div>
    <div class="col-12 col-md-10">
        <?php include_once "includes/top-menu.php" ?>

        <section class="filter">
            <div class="filter__left">
                <div class="tags modal">
                    <div class="tags__icon"></div>
                    <p class="tags__title">Все роллы</p>
                    <ul class="tags__list">
                        <li class="tags__item">
                            <input name="tags-radio" id="0" class="tags__input" type="radio" checked>
                            <label class="tags__item-view tags__item-view--roll" for="0">Все роллы</label>
                        </li>
                        <li class="tags__item">
                            <input name="tags-radio" id="1" class="tags__input" type="radio">
                            <label class="tags__item-view tags__item-view--pepper" for="1">Острые</label>
                        </li>
                        <li class="tags__item">
                            <input name="tags-radio" id="2" class="tags__input" type="radio">
                            <label class="tags__item-view tags__item-view--fire" for="2">Горячие</label>
                        </li>
                        <li class="tags__item">
                            <input name="tags-radio" id="3" class="tags__input" type="radio">
                            <label class="tags__item-view tags__item-view--hot" for="3">Запеченые</label>
                        </li>
                        <li class="tags__item">
                            <input name="tags-radio" id="4" class="tags__input" type="radio">
                            <label class="tags__item-view tags__item-view--handroll" for="4">Хенд роллы</label>
                        </li>
                    </ul>
                </div>
                <div class="contains modal">
                    <p class="contains__title">Ингредиенты</p>
                    <div class="contains__box">
                        <div class="contains__wrapper">
                            <ul class="contains__list">
                                <li class="contains__category">
                                    <img class="contains__category-img" src="img/icons/meat.png" alt="">
                                    <ul class="contains__category-list">
                                        <li class="contains__item">
                                            <div class="contains__label">
                                                <div class="contains__img-container">
                                                    <img class="contains__img" src="img/icons/contains/kura.png" alt="">
                                                </div>
                                                <p class="contains__name">Куринная грудка</p>
                                            </div>
                                        </li>
                                        <li class="contains__item">
                                            <div class="contains__label">
                                                <div class="contains__img-container">
                                                    <img class="contains__img" src="img/icons/contains/omlet.png" alt="">
                                                </div>
                                                <p class="contains__name">Японский омлет</p>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                <li class="contains__category">
                                    <img class="contains__category-img" src="img/icons/fish.png" alt="">
                                    <ul class="contains__category-list">
                                        <li class="contains__item">
                                            <div class="contains__label">
                                                <div class="contains__img-container">
                                                    <img class="contains__img" src="img/icons/contains/ikra.png" alt="">
                                                </div>
                                                <p class="contains__name">Красная икра</p>
                                            </div>
                                        </li>
                                        <li class="contains__item">
                                            <div class="contains__label">
                                                <div class="contains__img-container">
                                                    <img class="contains__img" src="img/icons/contains/losos.png" alt="">
                                                </div>
                                                <p class="contains__name">Лосось</p>
                                            </div>
                                        </li>
                                        <li class="contains__item">
                                            <div class="contains__label">
                                                <div class="contains__img-container">
                                                    <img class="contains__img" src="img/icons/contains/ugor.png" alt="">
                                                </div>
                                                <p class="contains__name">Угорь</p>
                                            </div>
                                        </li>
                                        <li class="contains__item">
                                            <div class="contains__label">
                                                <div class="contains__img-container">
                                                    <img class="contains__img" src="img/icons/contains/krevetka.png" alt="">
                                                </div>
                                                <p class="contains__name">Креветка</p>
                                            </div>
                                        </li>
                                        <li class="contains__item">
                                            <div class="contains__label">
                                                <div class="contains__img-container">
                                                    <img class="contains__img" src="img/icons/contains/midii.png" alt="">
                                                </div>
                                                <p class="contains__name">Мидии</p>
                                            </div>
                                        </li>
                                        <li class="contains__item">
                                            <div class="contains__label">
                                                <div class="contains__img-container">
                                                    <img class="contains__img" src="img/icons/contains/tunec.png" alt="">
                                                </div>
                                                <p class="contains__name">Тунец</p>
                                            </div>
                                        </li>
                                        <li class="contains__item">
                                            <div class="contains__label">
                                                <div class="contains__img-container">
                                                    <img class="contains__img" src="img/icons/contains/krab.png" alt="">
                                                </div>
                                                <p class="contains__name">Снежный краб</p>
                                            </div>
                                        </li>
                                        <li class="contains__item">
                                            <div class="contains__label">
                                                <div class="contains__img-container">
                                                    <img class="contains__img" src="img/icons/contains/tobiko.png" alt="">
                                                </div>
                                                <p class="contains__name">Тобико</p>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                <li class="contains__category">
                                    <img class="contains__category-img" src="img/icons/cheese.png" alt="">
                                    <ul class="contains__category-list">
                                        <li class="contains__item">
                                            <div class="contains__label">
                                                <div class="contains__img-container">
                                                    <img class="contains__img" src="img/icons/contains/sir.png" alt="">
                                                </div>
                                                <p class="contains__name">Крем-сыр</p>
                                            </div>
                                        </li>
                                        <li class="contains__item">
                                            <div class="contains__label">
                                                <div class="contains__img-container">
                                                    <img class="contains__img" src="img/icons/contains/feta.png" alt="">
                                                </div>
                                                <p class="contains__name">Сыр фета</p>
                                            </div>
                                        </li>
                                        <li class="contains__item">
                                            <div class="contains__label">
                                                <div class="contains__img-container">
                                                    <img class="contains__img" src="img/icons/contains/mayonez.png" alt="">
                                                </div>
                                                <p class="contains__name">Японский майонез</p>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                <li class="contains__category">
                                    <img class="contains__category-img" src="img/icons/apple.svg" alt="">
                                    <ul class="contains__category-list">
                                        <li class="contains__item">
                                            <div class="contains__label">
                                                <div class="contains__img-container">
                                                    <img class="contains__img" src="img/icons/contains/avocado.png" alt="">
                                                </div>
                                                <p class="contains__name">Авокадо</p>
                                            </div>
                                        </li>
                                        <li class="contains__item">
                                            <div class="contains__label">
                                                <div class="contains__img-container">
                                                    <img class="contains__img" src="img/icons/contains/mango.png" alt="">
                                                </div>
                                                <p class="contains__name">Манго</p>
                                            </div>
                                        </li>
                                        <li class="contains__item">
                                            <div class="contains__label">
                                                <div class="contains__img-container">
                                                    <img class="contains__img" src="img/icons/contains/chuka.png" alt="">
                                                </div>
                                                <p class="contains__name">Чука</p>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <button class="contains__clear">Сбросить всё</button>
                    </div>
                </div>
            </div>
            <div class="filter__right">
                <div class="tags modal tags--sort">
                    <p class="tags__title">По популярности</p>
                    <ul class="tags__list">
                        <li class="tags__item">
                            <input name="sort-radio" id="10" class="tags__input" type="radio" checked>
                            <label class="tags__item-view" for="10">По популярности</label>
                        </li>
                        <li class="tags__item">
                            <input name="sort-radio" id="11" class="tags__input" type="radio">
                            <label class="tags__item-view" for="11">По возрастанию цены</label>
                        </li>
                        <li class="tags__item">
                            <input name="sort-radio" id="12" class="tags__input" type="radio">
                            <label class="tags__item-view" for="12">По убыванию цены</label>
                        </li>
                        <li class="tags__item">
                            <input name="sort-radio" id="13" class="tags__input" type="radio">
                            <label class="tags__item-view" for="13">Сначала новинки</label>
                        </li>
                    </ul>
                </div>
            </div>
        </section>
        <div class="keywords keywords--catalog">
            <div class="keywords__box">
                <button class="keywords__item">
                    <div class="keywords__cross"></div>
                    <p class="keywords__text">Куринная грудка</p>
                </button>
                <button class="keywords__item">
                    <div class="keywords__cross"></div>
                    <p class="keywords__text">Красная икра</p>
                </button>
                <button class="keywords__item">
                    <div class="keywords__cross"></div>
                    <p class="keywords__text">Мидии</p>
                </button>

            </div>
        </div>

        <section class="products">
            <div class="row">
                <?php include "includes/catalog-product.php" ?>
                <?php include "includes/catalog-product.php" ?>
                <?php include "includes/catalog-product.php" ?>
                <?php include "includes/catalog-product.php" ?>
                <?php include "includes/catalog-product.php" ?>
                <?php include "includes/catalog-product.php" ?>
            </div>
        </section>

        <section class="banner">
            <div class="banner__extra banner__extra--roll">
                <svg class="banner__circle-img">
                    <use href="#roll"></use>
                </svg>
            </div>
            <div class="banner__extra banner__extra--text">
                <div class="banner__extra-text">акция</div>
            </div>
            <div class="banner__extra banner__extra--fish">
                <svg class="banner__circle-img">
                    <use href="#fish-symbol"></use>
                </svg>
            </div>

            <div class="banner__inner">
                <a href="#">
                    <img class="banner__img" src="img/banner1.png" alt="">
                    <img class="banner__img banner__img--mob" src="img/banner1-mob.png" alt="">
                </a>
                <div class="banner__left-border">
                    <div class="banner__symbols"></div>
                </div>
                <div class="banner__right-border">
                    <div class="banner__symbols"></div>
                </div>
            </div>
        </section>

        <section class="products">
            <div class="row">

                <?php include "includes/catalog-product.php" ?>
                <?php include "includes/catalog-product.php" ?>
                <?php include "includes/catalog-product.php" ?>
                <?php include "includes/catalog-product.php" ?>
                <?php include "includes/catalog-product.php" ?>
                <?php include "includes/catalog-product.php" ?>
        </section>
        <section class="pagination">
            <button class="pagination__prev"></button>
            <div class="bamboo pagination__bamboo">
                <div class="bamboo__cell pagination__cell">
                    <a class="pagination__link" href="#">1</a>
                </div>
                <div class="bamboo__cell pagination__cell">
                    <a class="pagination__link" href="#">...</a>
                </div>
                <div class="bamboo__cell pagination__cell">
                    <a class="pagination__link" href="#">4</a>
                </div>
                <div class="bamboo__cell pagination__cell">
                    <a class="pagination__link pagination__link--current" href="#">5</a>
                </div>
                <div class="bamboo__cell pagination__cell">
                    <a class="pagination__link" href="#">6</a>
                </div>
                <div class="bamboo__cell pagination__cell">
                    <a class="pagination__link" href="#">...</a>
                </div>
                <div class="bamboo__cell pagination__cell">
                    <a class="pagination__link" href="#">20</a>
                </div>
            </div>
            <button class="pagination__next"></button>
        </section>

        <?php include_once "includes/footer-section.php" ?>
    </div>


<?php include_once "includes/footer.php" ?>