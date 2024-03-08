<?php

class User {
    protected $UserID;
    protected $Email;
    protected $Password;

    public function __construct($UserID, $Email, $Password) {
        $this->UserID = $UserID;
        $this->Email = $Email;
        $this->Password = $Password;
    }

    public function getUserID() {
        return $this->UserID;
    }

    public function getEmail() {
        return $this->Email;
    }

    public function getPassword() {
        return $this->Password;
    }
}

?>