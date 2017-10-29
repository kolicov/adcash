<?php

class AdminMenu extends Phalcon\Mvc\User\Component
{

    public function getMenu()
    {
        $view = new Phalcon\Mvc\View\Simple();
        $view->setViewsDir('../app/modules/order/views/');
        echo $view->render("widgets/menu");
    }

}
