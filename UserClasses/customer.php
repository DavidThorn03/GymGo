<?php
require "user.php";
class Customer extends User {
    protected $Fname;
    protected $Sname;
    protected $DOB;
    protected $EirCode;
    protected $Phone;

    public function __construct($UserID, $Email, $Password, $Fname, $Sname, $DOB, $EirCode, $Phone) {
        parent::__construct($UserID, $Email, $Password);
        $this->Fname = $Fname;
        $this->Sname = $Sname;
        $this->DOB = $DOB;
        $this->EirCode = $EirCode;
        $this->Phone = $Phone;
    }

    public function getFname() {
        return $this->Fname;
    }

    public function getSname() {
        return $this->Sname;
    }

    public function getDOB() {
        return $this->DOB;
    }

    public function getEirCode() {
        return $this->EirCode;
    }

    public function getPhone() {
        return $this->Phone;
    }
}

?>
