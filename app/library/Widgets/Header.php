<?php
/**
 * Created by PhpStorm.
 * User: pkolitsov
 * Date: 10.07.17
 * Time: 10:50
 */

namespace Widgets;


class Header extends \Phalcon\Mvc\User\Component
{
  public function navigation() {
    $view = new \Phalcon\Mvc\View\Simple();
    $view->setViewsDir('../app/modules/frontend/views/');

    $items = \Models\HomepageSection::find();
    $view->setVars(array(
      'items' => $items,
      'product_count' => \Models\Product::count(),
    ));

    echo $view->render("widgets/navigation");
  }

  public function meta()
  {

    $meta = \Models\Settings::findFirst();
    if ($meta) {
      echo '<title>bumax</title>';
      echo '<meta name = "description" content = "' .  $meta->getMetaDescription(). '">';
      echo '<meta property="og:keywords" content="' . $meta->getMetaKey() . '" />';

      echo '<meta property="og:title" content="bumax" />';
      echo '<meta property="og:site_name" content="bumax.bg" />';
      echo '<meta property="og:url" content="' . 'http://bumax.bg' . $this->request->getURI() . '" />';
      echo '<meta property="og:description" content="' . $meta->getMetaDescription() . '" />';
    }
  }
}