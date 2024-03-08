<?php

class LessonTime extends Lesson{
    private $lessonTimeID;
    private $day;
    private $time;

    public function __construct($LessonTime){
        $this->lessonTimeID = $LessonTime["LessonTimeID"];
        $this->day = $LessonTime["Day"];
        $this->time = $LessonTime["Time"];
    }

    public function getDay(){
        return $this->day;
    }

    public function getTime(){
        return $this->time;
    }

    public function getLessonTimeID(){
        return $this->lessonTimeID;
    }

    public function setLessonTimeID($lessonTimeID){
        $this->lessonTimeID = $lessonTimeID;
    }

    public function setDay($day){
        $this->day = $day;
    }

    public function setTime($time){
        $this->time = $time;
    }

}
?>
