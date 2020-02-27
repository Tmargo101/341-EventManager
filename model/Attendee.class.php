<?php
	
	class Attendee {
		private $idattendee, $name, $password, $role;

        /**
         * @return mixed
         */
        public function getIdattendee() {
            return $this->idattendee;
        }

        /**
         * @param mixed $idattendee
         */
        public function setIdattendee($idattendee) {
            $this->idattendee = $idattendee;
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
        public function getPassword() {
            return $this->password;
        }

        /**
         * @param mixed $password
         */
        public function setPassword($password) {
            $this->password = $password;
        }

        /**
         * @return mixed
         */
        public function getRole() {
            return $this->role;
        }

        /**
         * @param mixed $role
         */
        public function setRole($role) {
            $this->role = $role;
        }

        public function getTableHeader() {
			$row = "
				<th>Attendee ID</th>
				<th>Name</th>
				<th>Role</th>
			";
            return $row;
        }

//
//		public function returnColumns() {
//			$row = "
//				<td>{$this->idattendee}</td>
//				<td>{$this->name}</td>
//				<td>{$this->role}</td>
//			";
//
//			return $row;
//		}
//
//		public function returnActionColumn() {
//			$row = "
//				<td><button>Edit User</button><button>Remove User</button></td>
//			";
//
//			return $row;
//		}
	}