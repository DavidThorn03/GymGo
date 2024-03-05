<?php

class BookedLesson extends LessonTime{
    private $userID;
    private $bookedLessonID;
    public function __construct($lessonTime, $bookedLesson){
        parent::__construct($lessonTime);
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