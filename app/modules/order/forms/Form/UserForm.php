<?php

namespace Modules\Order\Forms\Form;

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\TextArea;
use Phalcon\Forms\Element\Hidden;

class UserForm extends Form {

    /**
     * Forms initializer
     *
     * @param Call back item
     */
    public function initialize($item) {
        $this->add(new Hidden("id"));
        $this->add(new Text("first_name"));
        $this->add(new Text("last_name"));
        $this->add(new Text("phone"));
        $this->add(new TextArea("address"));
    }

}
