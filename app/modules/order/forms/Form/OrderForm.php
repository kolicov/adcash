<?php

namespace Modules\Order\Forms\Form;

use Models\User;
use Models\Product;
use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Numeric;
use Phalcon\Forms\Element\Select;
use Phalcon\Forms\Element\Hidden;

class OrderForm extends Form {

    /**
     * Forms initializer
     *
     * @param Call back item
     */
    public function initialize($item) {
        $this->add(new Hidden("id"));
        $quantity = new Numeric("quantity");

        foreach ($item->getProducts() as $productItem) {
            $quantity->setDefault($productItem->getQuantity());
            break;
        }
        $this->add($quantity);

        $user_options = array();
        foreach (User::find() as $user) {
            $user_options[$user->getId()] = $user->getFirstName() . ' ' . $user->getLastName();
        }

        $users = new Select('user_id', $user_options);

        $users->setDefault($item->getUserId());
        $this->add($users);

        $product = new Select('product_id', Product::find(), array("using" => array("id", "title")));
        if (!empty($productItem)) {
            $product->setDefault($productItem->getProduct()->getId());
        }
        $this->add($product);
    }

}
