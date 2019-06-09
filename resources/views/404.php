<?php
/**
 * @var \app\model\Good $goods
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
    <body
        <div class="store"
            <div class="container">
                <h1 class="store__title">404! Нет такой страницы.</h1>
                <h2 class="store__info"><?= $params['error'] ?></h2>
                <a type="button" class="btn btn-primary active btn-block" href="<?=Router::getUrl('home')?>">К каталогу</a>
            </div>
        </div>
    <script type="text/javascript" src="/public/main.js"></script>
    </body>
</html>