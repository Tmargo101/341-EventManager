<?php
/*To do in this file: Create a sanatize class with STATIC METHODS to sanatize any input and return the sanatized input*/	

	class Sanatize {
		static function sanatizeString($inString) {
			return strip_tags(htmlspecialchars($inString));
		}
	}
?>