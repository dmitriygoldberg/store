<?php
/**
 * @var \app\model\Good $goods
 * @var \app\model\Order $order
 */
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Заказ</title>

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
        <h1 class="order__title">Заказ от <?=$order->created_at;?></h1>
        <h2 class="order__info">Статус заказа - <div class="order__info-status"><?=\app\model\Order::STATUS[$order->status]?></div></h2>
            <table class="order__table table table-hover">
                <thead>
                <tr>
                    <th></th>
                    <th>Наименование</th>
                    <th>Цена</th>
                </tr>
                </thead>
                <tbody>
                <?php $total = 0 ?>
                <?php foreach($goods as $key => $good): ?>
                    <tr class="order__good" id="<?=$good->id ?>">
                        <td class="order__good-thumbnail"><img class="order__good-img center-block" src="<?= $good->thumbnail ?>" alt=""></td>
                        <td class="order__good-name"><?=$good->name ?></td>
                        <td class="order__good-price-table"><?=$good->price ?> руб.</td>
                        <input class="order__good-price" id="<?=$good->id ?>" value="<?=$good->price ?>" type="text" hidden></input>
                    </tr>
                    <?php $total += $good->price ?>
                <?php endforeach; ?>
                </tbody>
            </table>
            <div class="order__total-price">ИТОГО: <?=$total ?> руб.</div>
            <div class="order__buttons">
            <a type="button" class="order__to-store btn btn-info" href="<?=Router::getUrl('home')?>">К каталогу</a>
                <?php if ($order->status == 0): ?>
                    <button type="button" class="order__remove btn btn-danger" id="<?=$order->id?>">
                        <span class="preloader spinner-border spinner-border-sm"></span>Отменить заказ</button>
                    <button type="button" class="order__pay btn btn-primary" id="<?=$order->id?>">
                        <span class="preloader spinner-border spinner-border-sm"></span>Оплатит заказ</button>
                <?php endif; ?>
            </div>
        </div>
    </div>

        <script type="text/javascript" src="/public/main.js"></script>
</body>
</html>