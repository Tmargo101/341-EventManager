<?php

/** @noinspection PhpUnused */

class Attendee_session {
    private $sessionID, $sessionName, $attendeeID, $attendeeName;
    private $venue, $startdate, $enddate;
    private $type = "Attendee_session";

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
    public function getVenue() {
        return $this->venue;
    }

    /**
     * @param mixed $venue
     */
    public function setVenue($venue) {
        $this->venue = $venue;
    }

    /**
     * @return mixed
     */
    public function getStartdate() {
        return $this->startdate;
    }

    /**
     * @param mixed $startdate
     */
    public function setStartdate($startdate) {
        $this->startdate = $startdate;
    }

    /**
     * @return mixed
     */
    public function getEnddate() {
        return $this->enddate;
    }

    /**
     * @param mixed $enddate
     */
    public function setEnddate($enddate) {
        $this->enddate = $enddate;
    }

    /**
     * @return mixed
     */
    public function getSessionID() {
        return $this->sessionID;
    }

    /**
     * @return mixed
     */
    public function getSessionName() {
        return $this->sessionName;
    }

    /**
     * @param mixed $sessionName
     */
    public function setSessionName($sessionName) {
        $this->sessionName = $sessionName;
    }

    /**
     * @return mixed
     */
    public function getAttendeeName() {
        return $this->attendeeName;
    }

    /**
     * @param mixed $attendeeName
     */
    public function setAttendeeName($attendeeName) {
        $this->attendeeName = $attendeeName;
    }

    /**
     * @param mixed $sessionID
     */
    public function setSessionID($sessionID) {
        $this->sessionID = $sessionID;
    }

    /**
     * @return mixed
     */
    public function getAttendeeID() {
        return $this->attendeeID;
    }

    /**
     * @param mixed $attendeeID
     */
    public function setAttendeeID($attendeeID) {
        $this->attendeeID = $attendeeID;
    }

}