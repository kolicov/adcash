<?php

//use Phalcon\Mvc\Router;
use Phalcon\Mvc\Router\Group as RouterGroup;

//$router = new Router();
//Create a group with a common module and controller
$order = new RouterGroup(array(
    'module' => 'order',
    'controller' => 'index',
        ));

// Index =======================================================
// Add a route to the group
$order->add('/', array(
    'controller' => 'index',
    'action' => 'index'
))->setName('index_index');

$order->addPost('multimedia/upload', array(
    'controller' => 'multimedia',
    'action' => 'upload'
))->via(array("GET", "POST"))->setName('upload_multimedia');

$order->add('/user/edit/:int', array(
    'controller' => 'user',
    'action' => 'edit',
    'id' => 1,
))->via(array("POST", "GET"))->setName('user_edit');

$order->add('/user/create', array(
    'controller' => 'user',
    'action' => 'create',
))->via(array("POST", "GET"))->setName('user_create');

$order->add('/oredrs/edit/:int', array(
  'controller' => 'orders',
  'action' => 'edit',
  'id' => 1,
))->via(array("POST", "GET"))->setName('order_edit');

$order->add('/oredrs/create', array(
  'controller' => 'orders',
  'action' => 'create',
))->via(array("POST", "GET"))->setName('order_create');

$router->mount($order);
