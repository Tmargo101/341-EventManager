<?php

/** @noinspection PhpUnused */

class Venue {
    private $idvenue, $name, $capacity;
    private $type = "Venue";

    /**
     * @return string
     */
    public function getType() {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType($type) {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getIdvenue() {
        return $this->idvenue;
    }

    /**
     * @param mixed $idvenue
     */
    public function setIdvenue($idvenue) {
        $this->idvenue = $idvenue;
    }

    /**
     * @return mixed
     */
    public function getName() {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name) {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getCapacity() {
        return $this->capacity;
    }

    /**
     * @param mixed $capacity
     */
    public function setCapacity($capacity) {
        $this->capacity = $capacity;
    }
}