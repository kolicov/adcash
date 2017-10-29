<?php

namespace Modules\Order\Forms\Form;

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Select;

class SearchForm extends Form {

    /**
     * Forms initializer
     *
     * @param Call back item
     */
    public function initialize($request) {
        $term = new Text("term");
        if (!empty($request->getQuery('term'))) {
            $term->setDefault($request->getQuery('term'));
        }
        $this->add($term);

        $options = array(
            '' => 'All times',
            '7' => 'Last 7 days',
            '0' => 'Today',
        );

        $select = new Select('date', $options);
        if (!empty($request->getQuery('date'))) {
            $select->setDefault($request->getQuery('date'));
        }
        $this->add($select);
    }

}
