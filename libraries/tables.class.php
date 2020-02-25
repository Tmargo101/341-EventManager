<?php

require_once "database/dbaccess_common.class.php";

class Tables {
    static function createTable() {
        $db = new DBAccess();
        $object = $db->getItem("*","attendee","name","french");
        var_dump($object);
    }
}