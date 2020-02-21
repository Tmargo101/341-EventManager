<?php
	
	class Event {
		private $idevent, $name, $datestart, $dateend, $numberallowed, $venue;
				
		public function returnColumns() {
			$row = "
				<td>{$this->idevent}</td>
				<td>{$this->name}</td>
				<td>{$this->datestart}</td>
				<td>{$this->dateend}</td>
				<td>{$this->numberallowed}</td>
				<td>{$this->venue}</td>
			";
			
			return $row;
		}
		
		public function returnActionColumn() {
			$row = "
				<td><button>Edit Event</button><button>Remove Event</button></td>
			";
			
			return $row;
		}

	}