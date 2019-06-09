<?php


namespace app\model;


use Illuminate\Database\Eloquent\Model;

class OrderGoods extends Model
{
    protected $table = 'order_goods';
    protected $primaryKey = ['order_id', 'good_id'];
    protected $fillable =['order_id', 'good_id'];
    public $timestamps = false;
    public $incrementing = false;

    public function order()
    {
        return $this->belongsTo('app\model\Order', 'order_id', 'id');
    }

    public function good()
    {
        return $this->belongsTo('app\model\Good', 'good_id', 'id');
    }
}