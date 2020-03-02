<?php /** @noinspection PhpUnused */


class CRUD {
    public static function whatToDo($inGETValues) {
        switch (array_keys($inGETValues)[0]) {
            case "add":
                echo HTMLElements::addDialog($inGETValues);
                break;
            case "edit":
                echo HTMLElements::editDialog($inGETValues);
                break;
            case "delete":
                echo HTMLElements::deleteDialog($inGETValues);
                break;
            case "register":
                break;
        }
    } // End whatToDo

    public static function deleteFromDB() {

    }

    public static function addToDB() {

    }

    public static function editDB() {

    }


}