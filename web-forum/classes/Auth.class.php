<?php
require_once('ForumDB.class.php');

class Auth {

    private $db;

    function __construct() {
        $this->db = new ForumDB();
    }

    function userExists($username) {
        return $this->db->userExists($username);
    }

    function checkLogin($username, $password) {
        return $this->db->checkLogin($username, $password);
    }

    function registrieren($username, $password) {
        if($this->userExists($username)){
            return false;
        }

        $this->db->addUser($username, $password);
        return true;
    }
}
