<?php

namespace Widgets;

class Template extends \Phalcon\Mvc\User\Component
{

  public function section($section, $index = NULL)
  {
    $view = new \Phalcon\Mvc\View\Simple();
    $view->setViewsDir('../app/modules/frontend/views/');

    $class = $index%2 == 0 ? 'lightbg' : '';

    $view->setVars(array('template' => $section, 'class' => $class, 'index' => $index));
    echo $view->render("widgets/template_{$section->getTemplateId()}");
  }
}