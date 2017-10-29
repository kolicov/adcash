<?php

namespace Modules\Order\Controllers;

use Models\Order;
use Models\OrderProduct;
use Modules\Order\Forms\Form\OrderForm;

class OrdersController extends ControllerBase {

    public function createAction() {
        if ($this->request->isPost()) {
            $item = new Order();
            $form = new OrderForm($item);
            $form->bind($this->request->getPost(), $item);
            if (!$item->save()) {
                foreach ($item->getMessages() as $message) {
                    echo $message, "\n";
                }
            } else {
                $ored_product = new OrderProduct();
                $ored_product->setProductId($this->request->getPost('product_id'));
        $ored_product->setOrderId($item->getId());
        $ored_product->setQuantity($this->request->getPost('quantity'));
        $ored_product->save();
      }
    }
    return $this->response->redirect('/');
  }

    public function editAction($id)
    {
        $item = Order::findFirstById($id);
        $form = new OrderForm($item);
        if (!empty($item) && $this->request->isPost()) {
          $form->bind($this->request->getPost(), $item);

          $ored_product = OrderProduct::findFirst("order_id = {$item->getId()}");
          if (!$ored_product) {
            $ored_product = new OrderProduct();
          }
          $ored_product->setProductId($this->request->getPost('product_id'));
          $ored_product->setOrderId($item->getId());
          $ored_product->setQuantity($this->request->getPost('quantity'));
          $ored_product->save();

          if (!$item->save()) {
                foreach ($item->getMessages() as $message) {
                    echo $message, "\n";
                }
            }
            return $this->response->redirect('/');
        } else if ($item) {
            $this->view->setVar('form', $form);
        }
    }

}
