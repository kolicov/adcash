<?php

namespace Modules\Order\Controllers;

use Modules\Order\Forms\Form\UserForm;
use Phalcon\Paginator\Adapter\Model as Paginator;

class UserController extends ControllerBase {

    public function indexAction() {
        $numberPage = $this->request->getQuery("pages", "int");
        if ($numberPage <= 0) {
            $numberPage = 1;
        }

        $items = \Models\User::find();
        if (count($items) == 0) {
            $this->flash->notice("Няма нови потребители");
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

    public function createAction() {
        $item = new \Models\User();
        $form = new UserForm($item);
        if ($this->request->isPost()) {
            $form->bind($this->request->getPost(), $item);
            if (!empty($this->request->getPost('password'))) {
                $item->setPassword(md5($this->request->getPost('password')));
            }
            if (!$item->save()) {
                print_r($item->getMessages());
                die;
                $this->view->form = $form;
            }
            return $this->response->redirect('admin/user');
        }
        $this->view->form = $form;
    }

    public function editAction($id) {
        $item = \Models\User::findFirstById($id);
        $form = new UserForm($item);
        if ($this->request->isPost()) {
            $form->bind($this->request->getPost(), $item);
            if (!empty($this->request->getPost('password'))) {
                $item->setPassword(md5($this->request->getPost('password')));
            }
            if (!$item->update()) {
                foreach ($item->getMessages() as $message) {
                    echo $message, "\n";
                }
            }
            return $this->response->redirect('admin/user');
        } else if ($item) {
            $this->view->setVar('item', $item);
        }
        $this->view->form = $form;
    }

    public function deleteAction($id) {
        $item = \Models\User::findFirstById($id);
        $item->delete();
        return $this->response->redirect('admin/user');
    }

}
