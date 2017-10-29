<?php
$menus = array(
  array(
    'name' => 'Orders', 'href' =>'/order/', 'icon' => 'fa fa-truck fa-fw',
  ),
  array(
    'name' => 'Products', 'href' =>'#', 'icon' => 'fa fa-eye fa-fw',
    "children" => array(
      array(
        'name' => 'All Products', 'href' =>'/order/product', 'icon' => 'fa fa-bar-chart-o fa-fw',
      ),
      array(
        'name' => 'Add new Product', 'href' =>'/order/product/create',
      ),
    ),
  ),
  array(
    'name' => 'Users', 'href' =>'#', 'icon' => 'fa fa-users fa-fw',
    "children" => array(
      array(
        'name' => 'All users', 'href' =>'/order/user',
      ),
      array(
        'name' => 'Add User', 'href' =>'/order/user/create',
      ),
    ),
  ),
);