<?php

/** @noinspection PhpUnused */

class Manager_event {
    private $event, $manager;

    /**
     * @return mixed
     */
    public function getEvent() {
        return $this->event;
    }

    /**
     * @param mixed $event
     */
    public function setEvent($event) {
        $this->event = $event;
    }

    /**
     * @return mixed
     */
    public function getManager() {
        return $this->manager;
    }

    /**
     * @param mixed $manager
     */
    public function setManager($manager) {
        $this->manager = $manager;
    }


}