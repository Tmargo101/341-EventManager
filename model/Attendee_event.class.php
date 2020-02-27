<?php


class Attendee_event {
    private $event, $attendee, $paid;

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
    public function getAttendee() {
        return $this->attendee;
    }

    /**
     * @param mixed $attendee
     */
    public function setAttendee($attendee) {
        $this->attendee = $attendee;
    }

    /**
     * @return mixed
     */
    public function getPaid() {
        return $this->paid;
    }

    /**
     * @param mixed $paid
     */
    public function setPaid($paid) {
        $this->paid = $paid;
    }


}