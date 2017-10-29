<?php

namespace Modules\Order\Controllers;

use Models\Order;
use Modules\Order\Forms\Form\OrderForm;
use Modules\Order\Forms\Form\SearchForm;
use Phalcon\Paginator\Adapter\Model as Paginator;

class IndexController extends ControllerBase
{

  public function indexAction()
  {
    $numberPage = $this->request->getQuery("pages", "int");
    if ($numberPage <= 0) {
      $numberPage = 1;
    }

    $searchForm = new SearchForm($this->request);
    $this->view->setVar("searchForm", $searchForm);

    $item = $this->modelsManager->createBuilder()->from('Models\Order');
      if ($term = $this->request->getQuery('term')) {
        $term = strip_tags($term);
        $item->leftJoin('Models\OrderProduct', 'op.order_id = Models\Order.id', 'op');
        $item->leftJoin('Models\Product', 'p.id = op.product_id', 'p');
        $item->andWhere("p.title like '%{$term}%'");

      }

      if ($days = $this->request->getQuery('date')) {
        $date = date('Y-m-d 00:00:00', strtotime("-$days days"));
        $item->andWhere("Models\Order.created >= '$date'");
      }

      $items = $item->getQuery()->execute();


    if (count($items) == 0) {
      $this->flash->notice("Now Orders");
    } else {
      $paginator = new Paginator(array(
        "data" => $items,
        "limit" => 20,
        "pages" => $numberPage
      ));
      $page = $paginator->getPaginate();
      $this->view->setVar("page", $page);
    }

    $order = new Order();
    $orderForm = new OrderForm($order);
    $this->view->setVar("form", $orderForm);
  }

}
