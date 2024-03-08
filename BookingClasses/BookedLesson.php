<?php

class BookedLesson extends LessonTime{
    private $userID;
    private $bookedLessonID;
    public function __construct($bookedLesson){
        $this->bookedLessonID = $bookedLesson["BookedLessonID"];
        $this->userID = $bookedLesson["UserID"];
    }

    public function getBookedLessonID()
    {
        return $this->bookedLessonID;
    }

    public function setBookedLessonID($bookedLessonID)
    {
        $this->bookedLessonID = $bookedLessonID;
    }
}
?>