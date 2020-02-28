<?php

/** @noinspection PhpUnused */

class Event {
    private $idevent, $name, $datestart, $dateend, $numberallowed, $venue;
    private $type = "Event";

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
    public function getIdevent() {
        return $this->idevent;
    }

    /**
     * @param mixed $idevent
     */
    public function setIdevent($idevent) {
        $this->idevent = $idevent;
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
    public function getDatestart() {
        return $this->datestart;
    }

    /**
     * @param mixed $datestart
     */
    public function setDatestart($datestart) {
        $this->datestart = $datestart;
    }

    /**
     * @return mixed
     */
    public function getDateend() {
        return $this->dateend;
    }

    /**
     * @param mixed $dateend
     */
    public function setDateend($dateend) {
        $this->dateend = $dateend;
    }

    /**
     * @return mixed
     */
    public function getNumberallowed() {
        return $this->numberallowed;
    }

    /**
     * @param mixed $numberallowed
     */
    public function setNumberallowed($numberallowed) {
        $this->numberallowed = $numberallowed;
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



//		public function returnColumns() {
//			$row = "
//				<td>{$this->idevent}</td>
//				<td>{$this->name}</td>
//				<td>{$this->datestart}</td>
//				<td>{$this->dateend}</td>
//				<td>{$this->numberallowed}</td>
//				<td>{$this->venue}</td>
//			";
//
//			return $row;
//		}
//
//		public function returnActionColumn() {
//			$row = "
//				<td><button>Edit Event</button><button>Remove Event</button></td>
//			";
//
//			return $row;
//		}

}