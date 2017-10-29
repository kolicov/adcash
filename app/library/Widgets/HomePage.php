<?php

namespace Widgets;

class HomePage extends \Phalcon\Mvc\User\Component
{

    public function slider()
    {
        $view = new \Phalcon\Mvc\View\Simple();
        $view->setViewsDir('../app/modules/frontend/views/');

        $slider = \Models\Slider::findFirst();
        $view->setVar('images', $slider->getImages());
        echo $view->render("widgets/slider");
    }

    public function items($category = null)
    {
        $view = new \Phalcon\Mvc\View\Simple();
        $view->setViewsDir('../app/modules/frontend/views/');

        if($category != null) {
            $title = $category->getName();
            $category_ids = array();
            $category_ids[] = $category->getId();
            foreach ($category->getChild() as $ch_category) {
                $category_ids[] = $ch_category->getId();
            }
        }else {
            $title = 'Последно разгледани';
        }

        $items = $this->modelsManager->createBuilder()
            ->from('Models\Items')
            ->andWhere('Models\Items.category_id IN('.implode(',',$category_ids).')')
            ->orderBy('Models\Items.price ASC')//, 'Rand()'
            ->limit(8)
            ->getQuery()
            ->execute();

        if(count($items) === 0) {
            return '';
        }
        $result = array();
        foreach($items as $item) {
            $result[] = $item;
        }

        $view->setVars(array('title' => $title, 'items' => $result));
        echo $view->render("widgets/items");
    }

}
