<?php

namespace Models;

use Phalcon\Mvc\Model;

abstract class BaseImages extends Model {

    protected $item_id = null;
    protected $image_id = null;

    /**
     * @return null
     */
    public function getItemId() {
        return $this->item_id;
    }

    /**
     * @param null $item_id
     */
    public function setItemId($item_id) {
        $this->item_id = $item_id;
    }

    /**
     * @return null
     */
    public function getImageId() {
        return $this->image_id;
    }

    /**
     * @param null $image_id
     */
    public function setImageId($image_id) {
        $this->image_id = $image_id;
    }

}
