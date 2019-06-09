<?php

use Phinx\Migration\AbstractMigration;

class CreatTableGood extends AbstractMigration
{
    /**
     * Migrate Up.
     */
    public function up()
    {
        $table = $this->table('good');
        $table->addColumn('name', 'string', ['limit' => 255, 'null' => false])
            ->addColumn('thumbnail', 'string', ['limit' => 255, 'null' => true])
            ->addColumn('price', 'integer', ['null' => false])
            ->insert([
                ['name'  => 'Рэй Бредбери. Самые знаменитые произведения', 'thumbnail'  => '/public/img/bredbery.jpg', 'price' => 100],
                ['name'  => 'Михаил Булгаков. Мастер и Маргарита', 'thumbnail'  => '/public/img/bulgakov.jpg', 'price' => 150],
                ['name'  => 'Антон Чехов. Рассказы', 'thumbnail'  => '/public/img/chehov.jpg', 'price' => 120],
                ['name'  => 'Агата Кристи. Десять негритят', 'thumbnail'  => '/public/img/desyat-negrityat.jpg', 'price' => 100],
                ['name'  => 'Елена Ульева. Энциклопедия для малышей', 'thumbnail'  => '/public/img/enciklopediya.jpg', 'price' => 140],
                ['name'  => 'О.Генри Фараон и хорал', 'thumbnail'  => '/public/img/faraon-i-khoral.jpg', 'price' => 170],
                ['name'  => 'Джоан Роулинг. Гарри Поттер и проклятое дитя', 'thumbnail'  => '/public/img/garri-potter-i-proklyatoe-ditya.jpg', 'price' => 130],
                ['name'  => 'Фёдор Достоевский. Идиот', 'thumbnail'  => '/public/img/idiot.jpg', 'price' => 180],
                ['name'  => 'Джордж Мартин. Игра престолов', 'thumbnail'  => '/public/img/igra-prestolov.jpg', 'price' => 160],
                ['name'  => 'Редьярд Киплинг. Книга джунглей', 'thumbnail'  => '/public/img/kniga-dzhunglej.jpg', 'price' => 140],
                ['name'  => 'One. One-punch Man', 'thumbnail'  => '/public/img/one-punch-man.jpg', 'price' => 110],
                ['name'  => 'Билл Уиллингхем. Сказки', 'thumbnail'  => '/public/img/skazki.jpg', 'price' => 180]])
            ->save();
    }

    /**
     * Migrate Down.
     */
    public function down()
    {
        $this->table('good')->drop()->save();
    }
}
