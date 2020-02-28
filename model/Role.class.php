<?php

/** @noinspection PhpUnused */

class Role {
    private $idrole, $name;

    /**
     * @return mixed
     */
    public function getIdrole() {
        return $this->idrole;
    }

    /**
     * @param mixed $idrole
     */
    public function setIdrole($idrole) {
        $this->idrole = $idrole;
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


}