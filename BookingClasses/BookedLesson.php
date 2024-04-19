<?php

class BookedLesson{
    private $date;
    private $userID;
    private $lessonTime;
    public function __construct($bookedLesson){
        if($bookedLesson != null){
            $this->date = $bookedLesson["Date"];
            $this->userID = $bookedLesson["UserID"];
            $this->lessonTime = $bookedLesson["LessonTimeID"];
        }
    }
    public function setLessonTime($lessonTime){
        $this->lessonTime = $lessonTime;
    }
    public function getUserID()
    {
        return $this->userID;
    }
    public function getDate()
    {
        $date = new DateTime($this->date);
        return $date->format('d-m-Y');
    }
    public function getLessonTime()
    {
        return $this->lessonTime;
    }
    public function makeBooking($userID, $lessonTime){
        $diff = $lessonTime->getDay() - date("w");
        if($diff < 0){
            $diff = $diff + 7;
        }
        $timestamp = date("Y-m-d");
        $date = date("Y-m-d", strtotime($timestamp . " +" . $diff . " days"));
        $this->date = $date;
        $this->userID = $userID;
        $this->lessonTime = $lessonTime;
    }
}
?>