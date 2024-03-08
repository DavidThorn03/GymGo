<?php

class Admin extends User {
    protected $AdminID;

    public function __construct($UserID, $Email, $Password, $AdminID) {
        parent::__construct($UserID, $Email, $Password);
        $this->AdminID = $AdminID;
    }

    public function getAdminID() {
        return $this->AdminID;
    }
}

?>