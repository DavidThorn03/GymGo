<?php
class Lesson
{
    private $lessonID;
    private $lessonName;
    private $durationMin;
    private $numPlaces;
    private $trainer;
    private $about;
    private $image;

    public function __construct($lesson){
        $this->lessonID = $lesson["LessonID"];
        $this->lessonName = $lesson["LessonName"];
        $this->durationMin = $lesson["DurationMin"];
        $this->numPlaces = $lesson["NumPlaces"];
        $this->trainer = $lesson["Trainer"];
        $this->about = $lesson["About"];
        $this->image = $lesson["ImageID"];
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
        return $this->image->getImageLink();
    }
    public function setImage($image){
        $this->image = $image;
    }
}
?>