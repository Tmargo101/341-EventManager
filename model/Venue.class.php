<?php


class Venue {
    private $idvenue, $name, $capacity;

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