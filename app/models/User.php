<?php

namespace Models;

use Phalcon\Mvc\Model;

class User extends Model {

    protected $id = null;
    protected $first_name = null;
    protected $last_name = null;
    protected $phone = NULL;
    protected $address = NULL;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getFirstName() {
        return $this->first_name;
    }

    public function setFirstName($first_name) {
        $this->first_name = $first_name;
    }

    public function getLastName() {
        return $this->last_name;
    }

    public function setLastNmae($last_name) {
        $this->last_name = $last_name;
    }

    public function getName() {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function getPhone() {
        return $this->phone;
    }

    public function setPhone($phone) {
        $this->phone = $phone;
    }

    public function getAddress() {
        return $this->address;
    }

    public function setAddress($address) {
        $this->address = $address;
    }

    public function initialize() {
        
    }

}
