<?php

class LessonTime{
    private $lessonTimeID;
    private $day;
    private $time;
    private $lessonID;

    public function __construct($LessonTime){
        $this->lessonTimeID = $LessonTime["LessonTimeID"];
        $this->day = $LessonTime["Day"];
        $this->time = $LessonTime["Time"];
        $this->lessonID = $LessonTime["LessonID"];
    }

    public function getDay(){
        return $this->day;
    }

    public function getTime(){
        return $this->time;
    }

    public function getLessonTimeID()
    {
        return $this->lessonTimeID;
    }
    public function getLessonID()
    {
        return $this->lessonID;
    }
}
?>
