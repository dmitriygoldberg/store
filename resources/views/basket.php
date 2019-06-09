<?php
/**
 * @var \app\model\Good $goods
 */
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Корзина</title>

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

<div class="basket">
    <div class="container">
        <?php
            $emptyClass = empty($goods) ? 'active' : '';
            $tableClass = !empty($goods) ? 'active' : '';
        ?>
        <div class="basket__empty <?=$emptyClass?>">
            <h1 class="basket__title">На данный момент корзина пустая</h1>
            <h2 class="basket__info">Посетите каталог для добавления товаров в корзину</h2>
            <a type="button" class="basket__to-store btn btn-primary btn-block" href="<?=Router::getUrl('home')?>">К каталогу</a>
        </div>
        <div class="basket__table-wrapper <?=$tableClass?>">
            <h1 class="basket__title">Товары в корзине</h1>
            <table class="basket__table table table-hover">
                <thead>
                <tr>
                    <th></th>
                    <th>Наименование</th>
                    <th>Цена</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <?php $total = 0 ?>
                <?php foreach($goods as $key => $good): ?>
                    <tr class="basket__good" id="<?=$good->id ?>">
                        <td class="basket__good-thumbnail"><img class="basket__good-img center-block" src="<?= $good->thumbnail ?>" alt=""></td>
                        <td class="basket__good-name"><?=$good->name ?></td>
                        <td class="basket__good-price-table"><?=$good->price ?> руб.</td>
                        <td>
                            <span class="basket__rm-good-btn fa fa-trash" id="<?= $good->id ?>"></span>
                        </td>
                        <input class="basket__good-price" id="<?=$good->id ?>" value="<?=$good->price ?>" type="text" hidden></input>
                    </tr>
                    <?php $total += $good->price ?>
                <?php endforeach; ?>
                </tbody>
            </table>
            <div class="basket__total-price">ИТОГО:  <div class="basket__total-price-value"><?=$total ?></div> руб.</div>
            <div class="basket__buttons">
                <a type="button" class="basket__to-store btn btn-info" href="<?=Router::getUrl('home')?>">К каталогу</a>
                <button type="button" class="basket__to-order btn btn-primary" href="<?=Router::getUrl('order')?>">
                    <span class="preloader spinner-border spinner-border-sm"></span>Оформить заказ</button>
            </div>
        </div>
    </div>

        <script type="text/javascript" src="/public/main.js"></script>
</body>
</html>