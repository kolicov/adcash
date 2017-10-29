<?php

namespace Modules\Order\Controllers;

use Models\Product;
use Modules\Order\Forms\Form\ProductForm;
use Phalcon\Paginator\Adapter\Model as Paginator;

class ProductController extends ControllerBase {

    public function indexAction() {
        $numberPage = $this->request->getQuery("pages", "int");
        if ($numberPage <= 0) {
            $numberPage = 1;
        }

        $items = \Models\Product::find();
        if (count($items) == 0) {
            $this->flash->notice("Няма страници");
      } else {
        $paginator = new Paginator(array(
          "data" => $items,
          "limit" => 20,
          "page" => $numberPage
        ));
        $page = $paginator->getPaginate();
        $this->view->setVar("page", $page);
      }
    }

    public function createAction()
    {
      $item = new Product();
      $form = new ProductForm($item);
      if ($this->request->isPost()) {
        $form->bind($this->request->getPost(), $item);
        if (!$item->save()) {
          print_r($item->getMessages());die;
        }

        $image_urls = $this->request->getPost('image_urls');
        $image_description = $this->request->getPost('image_description');
        foreach ($image_urls as $i => $image) {
          $image = $this->saveImage($image, $item->getId(), $i, !empty($image_description[$i]) ? $image_description[$i] : '');
          $homepage_section_item = new \Models\ProductImage();
          $homepage_section_item->setImageId($image->getId());
          $homepage_section_item->setItemId($item->getId());
          $homepage_section_item->save();
        }

        return $this->response->redirect('/order/product');
      }
      $this->view->form = $form;
    }

    public function editAction($id)
    {
      $item = \Models\Product::findFirstById($id);
      $form = new ProductForm($item);
      if ($this->request->isPost()) {
        $form->bind($this->request->getPost(), $item);
        if (!$item->update()) {
          foreach ($item->getMessages() as $message) {
            echo $message, "\n";
          }
        }

        $image_ids = $this->request->getPost('image_ids');
        $image_urls = $this->request->getPost('image_urls');
        $image_descriptions = $this->request->getPost('image_description');
        $this->removeImages($image_ids, $item, '\Models\ProductImage');
        foreach ($image_urls as $i => $image) {
          if ($image_ids[$i] == '') {
            $imageS = $this->saveImage($image, $item->getId(), $i, !empty($image_descriptions[$i]) ? $image_descriptions[$i] : '');
            $homepage_section_item = new \Models\ProductImage();
            $homepage_section_item->setImageId($imageS->getId());
            $homepage_section_item->setItemId($item->getId());
            $homepage_section_item->save();
          }
          else {
            $this->updateImage($image_ids[$i], $i, !empty($image_descriptions[$i]) ? $image_descriptions[$i] : '');
          }
        }

        return $this->response->redirect('/order/product');
      }
      $this->view->setVars(array('form' => $form, 'images' => $item->getImages()));
    }

    public function deleteAction($id)
    {
      $item = \Models\Product::findFirstById($id);
      $this->removeImages(array(), $item, '\Models\ProductImage');
      $item->delete();
      return $this->response->redirect('/order/product');
    }

}
