<?php


namespace app\controllers;

use app\app\helpers\Request;
use app\app\helpers\Session;
use app\model\Good;
use app\model\Order;
use app\model\OrderGoods;
use Curl\Curl;

/**
 * Class OrderController
 * @package app\controllers
 */
class OrderController extends Controller
{
    private $paymentAgentUrl = 'https://ya.ru';

    /**
     * @return bool|mixed
     */
    public function showOrder()
    {
        $orderId = Request::get('id');
        if (is_null($orderId)) {
            return false;
        }

        //default user ID
        $userId = 1;
        $order = Order::query()
            ->where('id', $orderId)
            ->where('user_id', $userId)
            ->with('orderGoods')
            ->get()->first();

        $goodList = [];
        foreach ($order->orderGoods as $orderGoods) {
            $goodList[] = $orderGoods->good_id;
        }

        $goods = (!empty($goodList)) ? Good::query()->whereIN('id', $goodList)->get()->all() : [];
        return $this->render('order', ['goods' => $goods, 'order' => $order]);
    }

    /**
     * @return bool
     */
    public function showHistory()
    {
        //default user ID
        $userId = 1;
        $orders = Order::query()
            ->where('user_id', $userId)
            ->get()->all();

        $this->render('order-history', ['orders' => $orders]);
        return true;
    }

    /**
     * @return bool
     */
    public function addOrder()
    {
        $basket = Session::get('goods');
        if (is_null($basket)) {
            $this->ajaxResponse(['Basket is empty'], false);
            return false;
        }

        $goods = Good::query()
            ->whereIn('id', $basket)
            ->get()
            ->all();

        $totalPrice = 0;
        foreach ($goods as $good) {
            $totalPrice += $good->price;
        }

        //Default user id
        $userId = 1;
        try {
            $order = Order::create(['user_id' => $userId, 'total_price' => $totalPrice]);
        } catch (\Exception $e) {
            $this->ajaxResponse([$e->getMessage()], false);
            return false;
        }

        foreach ($goods as $good) {
            try {
                OrderGoods::create(['order_id' => $order->id, 'good_id' => $good->id]);
            } catch (\Exception $e) {
                $this->ajaxResponse([$e->getMessage()], false);
                return false;
            }
        }
        Session::delete('goods');
        $this->ajaxResponse(['orderId' => $order->id]);
        return true;
    }

    /**
     * @return bool
     */
    public function removeOrder()
    {
        $orderId = Request::get('id');
        if (is_null($orderId)) {
            $this->ajaxResponse(['Miss parameter ID'], false);
            return false;
        }

        try {
            Order::query()
                ->where('id', $orderId)
                ->update(['status' => Order::STATUS_CANCELED]);
        } catch (\Exception $e) {
            $this->ajaxResponse([$e->getMessage()], false);
            return false;
        }

        $this->ajaxResponse(['status' => Order::STATUS[Order::STATUS_CANCELED]]);
        return true;
    }

    /**
     * @return bool
     * @throws \ErrorException
     */
    public function pay()
    {
        $orderId = Request::get('id');
        if (is_null($orderId)) {
            $this->ajaxResponse(['Miss parameter ID'], false);
            return false;
        }

        $curl = new Curl();
        $curl->get($this->paymentAgentUrl);
        if (!$curl->isSuccess()) {
            $this->ajaxResponse([$curl->getErrorMessage()], false);
            return false;
        }

        try {
            Order::query()
                ->where('id', $orderId)
                ->update(['status' => Order::STATUS_PAID]);
        } catch (\Exception $e) {
            $this->ajaxResponse([$e->getMessage()], false);
            return false;
        }

        $this->ajaxResponse(['status' => Order::STATUS[Order::STATUS_PAID]]);
        return true;
    }
}