<?php

class BookedLesson extends LessonTime{
    private $date;
    private $userID;
    private $bookedLessonID;
    public function __construct($bookedLesson){
        if($bookedLesson != null){
            $this->date = $bookedLesson["Date"];
            $this->bookedLessonID = $bookedLesson["BookedLessonID"];
            $this->userID = $bookedLesson["UserID"];
        }
    }
    public function getUserID()
    {
        return $this->userID;
    }
    public function getDate()
    {
        $date = new DateTime($this->date);
        return $date->format('Y-m-d');
    }

    public function getBookedLessonID()
    {
        return $this->bookedLessonID;
    }

    public function makeBooking($userID, $lessonTime){
        $diff = $lessonTime->getDay() - date("w");
        if($diff < 0){
            $diff = $diff + 7;
        }
        $date = date('Y-m-d', strtotime(' + $diff days'));
        $this->date = $date;
        $this->userID = $userID;
    }

}
?>