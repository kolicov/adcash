<?php

namespace Models;

use Phalcon\Mvc\Model;

class Order extends Model {

    /**
     * Order id
     * @var int
     */
    protected $id = null;

    /**
     * Order user_id
     * @var int
     */
    protected $user_id = null;

    /**
     * Order date
     * @var datetime
     */
    protected $create = null;

    function getId() {
        return $this->id;
    }

    function getUserId() {
        return $this->user_id;
    }

    function getCreate() {
        return date_format(date_create($this->create), 'd F Y, g:i A');
    }

    function setId($id) {
        $this->id = $id;
    }

    function setUserId($user_id) {
        $this->user_id = $user_id;
    }

    function setCreate($create) {
        $this->create = $create;
    }

    public function getFirstProduct() {
        $productItems = $this->getProducts();
        foreach ($productItems as $productItem) {
            return $productItem->getProduct();
        }
    }

    public function getQuantity() {
        $productItems = $this->getProducts();
        foreach ($productItems as $productItem) {
            return $productItem->getQuantity();
        }
    }

    function getTotalPrice() {
        $total = 0;
        $procurementItems = $this->getProducts();
        foreach ($procurementItems as $procurementItem) {
            $item = $procurementItem->getProduct();
            if (method_exists($item, 'getPrice')) {
                $price = $procurementItem->getQuantity() * $item->getPrice();
                $discount = 0;
                if ($procurementItem->getQuantity() >= 3) {
                    $discount = (20 / 100) * $price;
                }
                $total += number_format((float) $price - $discount, 2, '.', '');
            }
        }
        return $total != 0 ? number_format($total, 2, '.', '') : $total;
    }

    public function initialize() {

        $this->belongsTo("user_id", "Models\User", "id", array(
            'alias' => 'User'
        ));

        $this->hasMany("id", "Models\OrderProduct", "order_id", array(
            'alias' => 'Products'
        ));
    }

}
