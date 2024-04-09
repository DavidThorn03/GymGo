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
    private $lessonTimes;

    public function __construct($lesson){
        $this->lessonID = $lesson["LessonID"];
        $this->lessonName = $lesson["LessonName"];
        $this->durationMin = $lesson["DurationMin"];
        $this->numPlaces = $lesson["NumPlaces"];
        $this->trainer = $lesson["Trainer"];
        $this->about = $lesson["About"];
        $this->lessonTimes = array();
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
        if($this->image != null){
            return $this->image->getImageLink();
        }
    }

    public function getImage(){
        return $this->image;
    }
    public function setImage($image){
        $this->image = $image;
    }
    public function getLessonTimes(){
        return $this->lessonTimes;
    }
    public function addLessonTime($lessonTime){
        $this->lessonTimes[] = $lessonTime;
    }
    public function removeLessonTime($lessonTime){
        $key = array_search($lessonTime, $this->lessonTimes);
        unset($this->lessonTimes[$key]);
    }
    public function getLessonTime($lessonTimeID){
        foreach($this->lessonTimes as $lessonTime){
            if($lessonTime->getLessonTimeID() == $lessonTimeID){
                return $lessonTime;
            }
        }
    }
}
?>