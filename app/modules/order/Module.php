<?php

namespace Modules\Order;

use Shared\Phalcon\ModuleConfig;

class Module extends ModuleConfig
{

    /**
     * 
     * @param  $di
     */
    public function registerServices(\Phalcon\DiInterface $di)/** \Phalcon\DiInterface */
    {
        parent::registerServices($di);
    }

}
