<?php

/** @noinspection PhpUnused */

class Attendee_event {
    private $eventID, $eventName, $attendeeID, $attendeeName, $paid;
    private $venue, $datestart, $dateend;
    private $type = "Attendee_event";

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
    }/**
     * @param mixed $venue
     */
    public function setVenue($venue) {
        $this->venue = $venue;
    }/**
     * @return mixed
     */
    public function getDatestart() {
        return $this->datestart;
    }/**
     * @param mixed $datestart
     */
    public function setDatestart($datestart) {
        $this->datestart = $datestart;
    }/**
     * @return mixed
     */
    public function getDateend() {
        return $this->dateend;
    }/**
     * @param mixed $dateend
     */
    public function setDateend($dateend) {
        $this->dateend = $dateend;
    }


    /**
     * @return mixed
     */
    public function getEventName() {
        return $this->eventName;
    }

    /**
     * @param mixed $eventName
     */
    public function setEventName($eventName) {
        $this->eventName = $eventName;
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
     * @return mixed
     */
    public function getEventID() {
        return $this->eventID;
    }

    /**
     * @param mixed $eventID
     */
    public function setEventID($eventID) {
        $this->eventID = $eventID;
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