<?php

namespace Models;

use Phalcon\Mvc\Model;

class Images extends Model {

    protected $id = null;
    protected $image = null;
    protected $description = null;
    protected $index = null;

    /**
     * @return null
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @param null $id
     */
    public function setId($id) {
        $this->id = $id;
    }

    /**
     * @return null
     */
    public function getImage() {
        return $this->image;
    }

    /**
     * @param null $image
     */
    public function setImage($image) {
        $this->image = $image;
    }

    /**
     * @return null
     */
    public function getDescription() {
        return $this->description;
    }

    /**
     * @param null $description
     */
    public function setDescription($description) {
        $this->description = $description;
    }

    /**
     * @return null
     */
    public function getIndex() {
        return $this->index;
    }

    /**
     * @param null $index
     */
    public function setIndex($index) {
        $this->index = $index;
    }

}
