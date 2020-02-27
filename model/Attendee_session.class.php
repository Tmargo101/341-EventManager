<?php


class Attendee_session {
    private $session, $attendee;

    /**
     * @return mixed
     */
    public function getSession() {
        return $this->session;
    }

    /**
     * @param mixed $session
     */
    public function setSession($session) {
        $this->session = $session;
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

}