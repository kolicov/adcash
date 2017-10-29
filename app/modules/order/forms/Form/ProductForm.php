<?php

namespace Modules\Order\Forms\Form;

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Select;
use Phalcon\Forms\Element\TextArea;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Forms\Element\Check;

/**
 * Call back form
 *
 * This form can be used as create and edite.
 */
class ProductForm extends Form {

    /**
     * Forms initializer
     *
     * @param Call back item
     */
    public function initialize($item) {
        $this->add(new Hidden("id"));
        $this->add(new Text("title"));
        $this->add(new Text("price"));
        $this->add(new TextArea("description"));
    }

}
