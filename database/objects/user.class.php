<?php
	
	class Attendee {
		private $idattendee, $name, $password, $role;
				
		public function returnColumns() {
			$row = "
				<td>{$this->idattendee}</td>
				<td>{$this->name}</td>
				<td>{$this->role}</td>
			";
			
			return $row;
		}
		
		public function returnActionColumn() {
			$row = "
				<td><button>Edit User</button><button>Remove User</button></td>
			";
			
			return $row;
		}
	}