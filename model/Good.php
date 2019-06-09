<?php


namespace app\model;


use Illuminate\Database\Eloquent\Model;

class Good extends Model
{
    protected $table = 'good';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'thumbnail', 'price'];
    public $timestamps = false;

    public function orderGoods()
    {
        return $this->hasMany('app\model\OrderGoods', 'good_id', 'id');
    }
}