<?php
return [
    '404' => 'StoreController@error404',
    '/' => 'StoreController@showStore',

    '/good/add' => 'StoreController@addGood',
    '/good/remove' => 'StoreController@removeGood',

    '/order' => 'OrderController@showOrder',
    '/order/add' => 'OrderController@addOrder',
    '/order/remove' => 'OrderController@removeOrder',
    '/order/pay' => 'OrderController@pay',
    '/order/history' => 'OrderController@showHistory',

    '/basket' => 'StoreController@showBasket',
];