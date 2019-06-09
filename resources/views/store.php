<?php
/**
 * @var \app\model\Good $goods
 * @var array$basket
 */
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Магазин</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="/public/style.css"/>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
            crossorigin="anonymous"></script>
</head>
<body>

<div class="store">
    <div class="container">
        <h1 class="store__title">Добро пожаловать
            <a type="button" class="store__to-basket btn btn-info" href="<?=Router::getUrl('basket')?>">Перейти в корзину
                <img src="/public/icon/cart-arrow-down-solid.svg" class="store__to-basket-icon"></img>
            </a>
            <a type="button" class="store__to-order-history btn btn-info" href="<?=Router::getUrl('order-history')?>">История заказов</a></h1>
        <h2 class="store__info">Ознакомьтесь с каталогом товаров</h2>

    </div>
    <div class="container">
        <?php $column = 0; ?>
        <?php foreach ($goods as $good): ?>
            <?php if ($column == 0): ?>
                <div class="row">
            <?php endif; ?>
                    <div class="col">
                        <div class="store__good ">
                            <img class="store__good-img center-block" src="<?= $good->thumbnail ?>" alt="">
                            <div class="store__good-title">
                                <?= $good->name ?>
                            </div>
                            <div class="store__good-price">
                                Цена: <?= $good->price ?> руб.
                            </div>
                            <?php
                                $basketClass = in_array($good->id, $basket) ? '' : 'active';
                                $goToBasketClass = !in_array($good->id, $basket) ? '' : 'active';
                            ?>

                            <button class="store__good-basket btn btn-primary <?=$basketClass?>" id="<?= $good->id ?>">
                                <span class="preloader spinner-border spinner-border-sm"></span>
                                Добавить в корзину
                                <img src="/public/icon/cart-arrow-down-solid.svg" class="store__good-basket-icon"></img>
                            </button>
                            <a class="store__good-go-to-basket btn btn-success <?=$goToBasketClass?>" id="<?= $good->id ?>" href="<?=Router::getUrl('basket')?>">
                                В корзине
                                <img src="/public/icon/cart-arrow-down-solid.svg" class="store__good-basket-icon"></img>
                            </a>
                        </div>
                    </div>
            <?php $column++; ?>
            <?php if ($column == 4): ?>
                <?php $column = 0; ?>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>

    </div>

        <script type="text/javascript" src="/public/main.js"></script>
</body>
</html>