# **Simplified online store**
This service is a web-site catalog online store, with the ability to add goods to the cart, checkout, payment and update the order.
Payment is carried out by imitation of sending a request to https://ya.ru/
***
Used by: PHP 7.2, HTML, CSS, JavaScript (jQuery, Webpack, PostCss).
HTML styling - Bootstrap 4.
Migrations are implemented using phinx - (https://phinx.org/).
Third-party PHP libraries:
* Illuminate Database - https://github.com/illuminate/database
* PHP Curl - https://github.com/php-curl-class/php-curl-class
***
# **Упрощённый интернет магазин**

Данный сервис представляет собой страницу-каталог интернет магазина, с возможностью добавления товаров в корзину, оформление заказа, оплаты и обновления заказа.
Оплата осуществляется имитацией отправки запраса на https://ya.ru/
***
Используется PHP 7.2, HTML, CSS, JavaScript (jQuery, Webpack, PostCss).
HTML стилизация - Bootstrap 4.
Миграции реализованы c использованием phinx - (https://phinx.org/).
Сторонние PHP библиотеки;
* Illuminate Database - https://github.com/illuminate/database
* PHP Curl - https://github.com/php-curl-class/php-curl-class

***
Database:
>CREATE TABLE `good` (
 	`id` INT(11) NOT NULL AUTO_INCREMENT,
 	`name` VARCHAR(255) NOT NULL,
 	`thumbnail` VARCHAR(255) NULL DEFAULT NULL,
 	`price` INT(11) NOT NULL,
 	PRIMARY KEY (`id`)
 )
 COLLATE='utf8_general_ci'
 ENGINE=InnoDB;
 
>CREATE TABLE `order` (
 	`id` INT(11) NOT NULL AUTO_INCREMENT,
 	`user_id` INT(11) NOT NULL,
 	`total_price` INT(11) NOT NULL DEFAULT '0',
 	`status` SMALLINT(6) NOT NULL DEFAULT '0',
 	`created_at` DATETIME NOT NULL,
 	`updated_at` DATETIME NOT NULL,
 	PRIMARY KEY (`id`)
 )
 COLLATE='utf8_general_ci'
 ENGINE=InnoDB;

>CREATE TABLE `order_goods` (
 	`order_id` INT(11) NOT NULL,
 	`good_id` INT(11) NOT NULL,
 	PRIMARY KEY (`order_id`, `good_id`),
 	INDEX `good_id` (`good_id`),
 	CONSTRAINT `order_goods_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`) ON UPDATE CASCADE ON DELETE CASCADE,
 	CONSTRAINT `order_goods_ibfk_2` FOREIGN KEY (`good_id`) REFERENCES `good` (`id`) ON UPDATE CASCADE ON DELETE CASCADE
 )
 COLLATE='utf8_general_ci'
 ENGINE=InnoDB;


***
You can view the script at the link:
>https://translationsystem.herokuapp.com/

Ознакомиться со скриптом можно по ссылке
>https://translationsystem.herokuapp.com/

* Author (автор): Dmitry Goldberg (Дмитрий Гольдберг)
* e-mail: dmitriy.goldberg@gmail.com