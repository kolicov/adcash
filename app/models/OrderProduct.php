<?php

namespace Models;

use Phalcon\Mvc\Model;

class OrderProduct extends Model {

    /**
     * Procurement Items id
     * @var int
     */
    protected $id = null;

    /**
     * Procurement Items item id
     * @var int
     */
    protected $product_id = null;

    /**
     * Procurement Items quantity
     * @var int
     */
    protected $quantity = null;

    /**
   * Procurement Items guest_id
   * @var int
   */
  protected $order_id = null;

  function getId()
  {
    return $this->id;
  }

  function getProductId()
  {
    return $this->product_id;
  }

  function getOrderId()
  {
    return $this->order_id;
  }

  function setId($id)
  {
    $this->id = $id;
  }

  function setProductId($product_id)
  {
    $this->product_id = $product_id;
  }

  function setOrderId($order_id)
  {
    $this->order_id = $order_id;
  }

  function getQuantity()
  {
    return $this->quantity;
  }

  function setQuantity($quantity)
  {
    $this->quantity = $quantity;
  }

  public function initialize()
  {

    $this->belongsTo("order_id", "Models\Order", "id", array(
      'alias' => 'Order'
    ));


    $this->belongsTo("product_id", "Models\Product", "id", array(
      'alias' => 'Product'
    ));
  }

}