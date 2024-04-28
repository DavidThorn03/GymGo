<?php
require "user.php";
class Customer extends User {
    protected $Fname;
    protected $Sname;
    protected $DOB;
    protected $EirCode;
    protected $Phone;
    protected $badge;
    protected $numBookings;

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

    public function getBadge(){
        return $this->badge;
    }

    public function setBadge($numBookings){
        if($numBookings <= 5){
            $this->badge = "Wooden";
        }
        else if($numBookings <= 10){
            $this->badge = "Stone";
        }
        else if($numBookings <= 15){
            $this->badge = "Iron";
        }
        else if($numBookings <= 20){
            $this->badge = "Bronze";
        }
        else if($numBookings <= 25){
            $this->badge = "Silver";
        }
        else if($numBookings <= 30){
            $this->badge = "Gold";
        }
        else if($numBookings <= 35){
            $this->badge = "Platinum";
        }
        else{
            $this->badge = "Diamond";
        }
    }
    public function getNumBookings(){
        return $this->numBookings;
    }
    public function setNumBookings($numBookings){
        $this->numBookings = $numBookings;
        $this->setBadge($numBookings);
    }
}

?>
