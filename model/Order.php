<?php


namespace app\model;


use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'order';
    protected $primaryKey = 'id';
    protected $fillable = ['user_id', 'total_price', 'status'];
    public $timestamps = true;

    const STATUS_NEW = 0;
    const STATUS_PAID = 1;
    const STATUS_CANCELED = 2;
    const STATUS = [
        0 => 'Новый',
        1 => 'Оплачено',
        2 => 'Отменено',
    ];

    public function orderGoods()
    {
        return $this->hasMany('app\model\OrderGoods', 'order_id', 'id');
    }
}