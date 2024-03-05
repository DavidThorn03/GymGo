<?php
class Lesson
{
    private $lessonID;
    private $lessonName;
    private $durationMin;
    private $numPlaces;
    private $trainer;
    private $about;
    private $imageLink;

    public function __construct($lesson){
        $this->lessonID = $lesson["LessonID"];
        $this->lessonName = $lesson["LessonName"];
        $this->durationMin = $lesson["DurationMin"];
        $this->numPlaces = $lesson["NumPlaces"];
        $this->trainer = $lesson["Trainer"];
        $this->about = $lesson["About"];
        $this->imageLink = $lesson["ImageLink"];
    }

    public function getLessonID(){
        return $this->lessonID;
    }

    public function getLessonName(){
        return $this->lessonName;
    }

    public function getDurationMin(){
        return $this->durationMin;
    }

    public function getNumPlaces(){
        return $this->numPlaces;
    }

    public function getTrainer(){
        return $this->trainer;
    }

    public function getAbout(){
        return $this->about;
    }

    public function getImageLink(){
        return $this->imageLink;
    }


    public function setLessonID($lessonID){
        $this->lessonID = $lessonID;
    }

    public function setLessonName($lessonName){
        $this->lessonName = $lessonName;
    }

    public function setDurationMin($durationMin){
        $this->durationMin = $durationMin;
    }

    public function setNumPlaces($numPlaces){
        $this->numPlaces = $numPlaces;
    }

    public function setTrainer($trainer){
        $this->trainer = $trainer;
    }

    public function setAbout($about){
        $this->about = $about;
    }

    public function setImageLink($imageLink){
        $this->imageLink = $imageLink;
    }

}
?>