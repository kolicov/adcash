<?php

namespace Widgets;

class Meta extends \Phalcon\Mvc\User\Component
{

    public function get($item)
    {

        if (!$this->dispatcher->getParam('item')) {
            if ($this->dispatcher->getParam('category')) {
                $title = str_replace('-', ' ', urldecode($this->dispatcher->getParam('category')));
                $description = 'Авточасти - ' . $title . ' за ' . str_replace('-', ' ', urldecode($this->dispatcher->getParam('modelType')));
            } else {
                $title = str_replace('-', ' ', urldecode($this->dispatcher->getParam('engin')));
                $description = 'Авточасти - ' . str_replace('-', ' ', urldecode($this->dispatcher->getParam('model'))) . ' за ' . $title;
            }
            $url = 'http://premiumparts.bg' . $this->request->getURI();
        } else {
            $description = mb_substr(strip_tags($item->getDescription()), 0, 150, 'UTF-8') . ' - ' . $item->getPriceClear();
            $title = $item->getName() . '- ' . $item->getPriceClear();
            $url = 'http://premiumparts.bg' . $this->request->getURI();
            $canonicalUrl = 'http://premiumparts.bg/' . str_replace(' ', '-', $item->getName() . '-' . $item->getId());
        }

        echo '<title>Авточасти - ' . $title . '</title>';
        echo '<meta name = "description" content = "' . $description . '">';
        echo '<meta property="og:keywords" content="' . $this->keylords() . '" />';

        echo '<meta property="og:title" content="' . $title . '" />';
        echo '<meta property="og:site_name" content="premiumparts.bg" />';
        echo '<meta property="og:url" content="' . $url . '" />';
        echo '<meta property="og:description" content="' . $description . '" />';
        if (method_exists($item, 'getImage'))
            echo '<meta property="og:image" content="http://premiumparts.bg' . $item->getImage() . '" />';

        if (isset($canonicalUrl)) {
            echo '<link rel="canonical" href="' . $canonicalUrl . '" />';
        }
    }

    public function getDefault()
    {

        if ($this->dispatcher->getParam('model')) {
            $title = 'Авточасти - ' . str_replace('-', ' ', urldecode($this->dispatcher->getParam('model')));
        } else if ($this->dispatcher->getParam('brand')) {
            $title = 'Авточасти -' . str_replace('-', ' ', urldecode($this->dispatcher->getParam('brand')));
        } else {
            $title = 'Авточасти';
        }

        echo '<title>' . $title . '</title>';
        echo '<meta name = "description" content = "Авточасти">';
        echo '<meta property="og:keywords" content="' . $this->keylords() . '" />';

        echo '<meta property="og:title" content="' . $title . '" />';
        echo '<meta property="og:site_name" content="premiumparts.bg" />';
        echo '<meta property="og:url" content="' . 'http://premiumparts.bg' . $this->request->getURI() . '" />';
        echo '<meta property="og:description" content="' . $title . '" />';
    }

    protected function keylords()
    {
        $keywords = 'авточасти';
        if ($this->dispatcher->getParam('brand')) {
            $keywords .= ', ' . $this->dispatcher->getParam('brand');
        }
        if ($this->dispatcher->getParam('category')) {
            $keywords .= ', ' . str_replace('-', ' ', urldecode($this->dispatcher->getParam('category')));
        }
        if ($this->dispatcher->getParam('model')) {
            $keywords .= ', ' . str_replace('-', ' ', urldecode($this->dispatcher->getParam('model')));
        }
        if ($this->dispatcher->getParam('engin')) {
            $keywords .= ', ' . str_replace('-', ' ', urldecode($this->dispatcher->getParam('engin')));
        }
        if ($this->dispatcher->getParam('modelType')) {
            $keywords .= ', ' . str_replace('-', ' ', urldecode($this->dispatcher->getParam('modelType')));
        }
        if ($this->dispatcher->getParam('item')) {
            $keywords .= ', ' . str_replace('-', ' ', urldecode($this->dispatcher->getParam('item')));
        }
        return $keywords;
    }

}
