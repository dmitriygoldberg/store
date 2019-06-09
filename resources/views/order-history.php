<?php
/**
 * @var \app\model\Order $orders
 */
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>История заказов</title>

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

<div class="order-history">
    <div class="container">
        <h1 class="order-history__title">История заказов</h1>
        <table class="order-history__table table table-hover">
            <thead>
            <tr>
                <th>№</th>
                <th>Дата заказа</th>
                <th>Стоимость</th>
                <th>Статус</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($orders as $key => $order): ?>
                <tr>
                    <td><?= $order->id ?></td>
                    <td><?= $order->created_at ?></td>
                    <td><?= $order->total_price ?> руб.</td>
                    <td><?= \app\model\Order::STATUS[$order->status] ?></td>
                    <td>
                        <a href="<?=Router::getUrl('order', ['id' => $order->id ])?>"><i class="fa fa-eye" aria-hidden="true"></i></a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <div class="order-history__buttons">
            <a type="button" class="order-history__to-store btn btn-primary" href="<?=Router::getUrl('home')?>">К каталогу</a>
        </div>
    </div>
</div>

        <script type="text/javascript" src="/public/main.js"></script>
</body>
</html>