<?php

namespace Widgets;

class Login extends \Phalcon\Mvc\User\Component
{

    public function header()
    {
        $view = new \Phalcon\Mvc\View\Simple();
        $view->setViewsDir('../app/modules/frontend/views/');

        if ($this->session->has('public_user')) {
            $view->setVar('user', $this->session->has('public_user'));
        }
        echo $view->render("widgets/header");
    }

    public function cuest()
    {

        if (!$this->session->has('public_user')) {
            $view = new \Phalcon\Mvc\View\Simple();
            $view->setViewsDir('../app/modules/frontend/views/');
            echo $view->render("widgets/cuest");
        }
    }

    public function cart()
    {
        $view = new \Phalcon\Mvc\View\Simple();
        $view->setViewsDir('../app/modules/frontend/views/');
        $items = array();
        if ($this->session->has('cart')) {
            foreach ($this->session->get('cart') as $item) {
                $product = \Models\Items::findFirstById($item->id);
                if ($product) {
                    $item_build = new \stdClass();
                    $item_build->item = $product;
                    $item_build->quantity = $item->quantity;
                    $items[] = $item_build;
                }
            }
        }
        $view->setVar('items', $items);
        echo $view->render("widgets/cart");
    }

    public function footer()
    {

        $view = new \Phalcon\Mvc\View\Simple();
        $view->setViewsDir('../app/modules/frontend/views/');

        $categories = \Models\Categories::find('parent_id = 0');
        $view->setParamToView('categories', $categories);

        echo $view->render("widgets/footer");
    }

}
