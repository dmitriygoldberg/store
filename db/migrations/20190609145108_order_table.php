<?php

use Phinx\Migration\AbstractMigration;

class OrderTable extends AbstractMigration
{
    /**
     * Migrate Up.
     */
    public function up()
    {
        $table = $this->table('order');
        $table->addColumn('user_id', 'integer', ['null' => false])
            ->addColumn('total_price', 'integer', ['null' => false, 'default' => 0])
            ->addColumn('status', 'smallinteger', ['null' => false, 'default' => 0])
            ->addColumn('created_at', 'datetime')
            ->addColumn('updated_at', 'datetime')
            ->save();

        $table = $this->table('order_goods', ['id' => false, 'primary_key' => ['order_id', 'good_id']]);
        $table->addColumn('order_id', 'integer')
            ->addColumn('good_id', 'integer')
            ->addForeignKey('order_id', 'order', 'id',
                ['delete'=> 'CASCADE', 'update'=> 'CASCADE'])
            ->addForeignKey('good_id', 'good', 'id',
                ['delete'=> 'CASCADE', 'update'=> 'CASCADE'])
            ->save();
    }

    /**
     * Migrate Down.
     */
    public function down()
    {
        $this->table('order')->drop()->save();
        $this->table('order_goods')->drop()->save();
    }
}
