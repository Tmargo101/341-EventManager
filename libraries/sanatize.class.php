<?php
/*To do in this file: Create a sanitize class with STATIC METHODS to sanitize any input and return the sanitized input*/

class Sanitize {
    static function sanatizeString($inString) {
        return strip_tags(htmlspecialchars($inString));
    }
}
