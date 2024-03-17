<?php

namespace GalleryClasses;

class Image
{
    private $imageID;
    private $imageLink;
    public function __construct($image)
    {
        $this->imageID = $image["ImageID"];
        $this->imageLink = $image["ImageLink"];
    }

    public function getImageID()
    {
        return $this->imageID;
    }
    public function getImageLink()
    {
        return $this->imageLink;
    }


}