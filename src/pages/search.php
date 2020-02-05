<?php include_once "includes/header.php" ?>

    <div class="col-0 col-md-2">
        <?php include_once "includes/menu.php" ?>
    </div>
    <div class="col-12 col-md-10">
        <?php include_once "includes/top-menu.php" ?>

        <div class="keywords">
            <div class="keywords__box">
                <button class="keywords__item">
                    <div class="keywords__cross"></div>
                    <p class="keywords__text">лосось</p>
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

        <?php include_once "includes/footer-section.php" ?>
    </div>


<?php include_once "includes/footer.php" ?>