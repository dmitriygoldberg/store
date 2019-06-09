<?php


namespace app\controllers;

use app\app\helpers\Request;
use app\app\helpers\Session;
use app\model\Good;

/**
 * Class StoreController
 * @package app\controllers
 */
class StoreController extends Controller
{
    /**
     * @return mixed
     */
    public function showStore()
    {
        $goods = Good::query()->get()->all();
        $basket = Session::get('goods');

        return $this->render('store', ['goods' => $goods, 'basket' => $basket]);
    }

    /**
     * @return mixed
     */
    public function showBasket()
    {
        $basket = Session::get('goods');
        $goods = !empty($basket) ? $goods = Good::query()->whereIn('id', $basket)->get()->all() : [];

        return $this->render('basket', ['goods' => $goods]);
    }

    /**
     * @return bool
     */
    public function addGood()
    {
        $goodId = Request::get('id');
        if (is_null($goodId)) {
            $this->ajaxResponse(['Missing parameter ID'], false);
            return false;
        }

        $goodsInBasket = Session::get('goods');
        if (!in_array($goodId, $goodsInBasket)) {
            $goodsInBasket[] = $goodId;
            Session::set('goods', $goodsInBasket);
        }

        $this->ajaxResponse();
        return true;
    }

    /**
     * @return bool
     */
    public function removeGood()
    {
        $goodId = Request::get('id');
        if (is_null($goodId)) {
            $this->ajaxResponse(['Missing parameter ID'], false);
            return false;
        }

        $goodsInBasket = Session::get('goods');
        if (in_array($goodId, $goodsInBasket)) {
            unset($goodsInBasket[array_search($goodId, $goodsInBasket)]);
            Session::set('goods', $goodsInBasket);
        }

        $this->ajaxResponse(['emptyBasket' => empty($goodsInBasket)]);
        return true;
    }

    /**
     * @return mixed
     */
    public function error404()
    {
        return $this->render('404');
    }
}