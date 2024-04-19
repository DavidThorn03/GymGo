<?php
require "../../BookingClasses/LessonTime.php";
//expected input test
$lessonTime1 = new LessonTime(array("LessonTimeID" => 1, "Day" => 1, "Time" => "10:00:00"));
echo "Expected value for getDay(): 1. Actual value: " . $lessonTime1->getDay() . "\n";
echo "Expected value for getTime(): 10:00:00. Actual value: " . $lessonTime1->getTime() . "\n";
echo "Expected value for getLessonTimeID(): 1. Actual value: " . $lessonTime1->getLessonTimeID() . "\n";

echo "\n";
//incorrect var types in array test
$lessonTime2 = new LessonTime(array("LessonTimeID" => "larry", "Day" => "Tuesday", "Time" => 11.30));
echo "Expected value for getDay(): Tuesday Actual value: " . $lessonTime2->getDay() . "\n";//will still run although this will break code running
echo "Expected value for getTime(): 11.3 Actual value: " . $lessonTime2->getTime() . "\n";//code will still run with incorrect display
echo "Expected value for getLessonTimeID(): Larry Actual value: " . $lessonTime2->getLessonTimeID() . "\n";//will still run although this will break code running

echo "\n";
//null input test
$lessonTime3 = new LessonTime(null);//will generate error in code as array is missing
echo "Expected value for getDay(): . Actual value: " . $lessonTime3->getDay() . "\n";//returning null since constructor didnt function
echo "Expected value for getTime(): . Actual value: " . $lessonTime3->getTime() . "\n";//returning null since constructor didnt function
echo "Expected value for getLessonTimeID(): . Actual value: " . $lessonTime3->getLessonTimeID() . "\n";//returning null since constructor didnt function

echo "\n";
//empty array test
$lessonTime4 = new LessonTime(array());//will generate error in code because of empty array
echo "Expected value for getDay(): . Actual value: " . $lessonTime4->getDay() . "\n";//returning null since constructor didnt function
echo "Expected value for getTime(): . Actual value: " . $lessonTime4->getTime() . "\n";//returning null since constructor didnt function
echo "Expected value for getLessonTimeID(): . Actual value: " . $lessonTime4->getLessonTimeID() . "\n";//returning null since constructor didnt function

echo "\n";
//incorrect array keys test
$lessonTime5 = new LessonTime(array("Lesson" => 1, "DayOfWeek" => 1, "Hour" => "10:00:00"));//will generate error in code because of incorrect array key
echo "Expected value for getDay(): 1. Actual value: " . $lessonTime5->getDay() . "\n";//returning null since constructor didnt function
echo "Expected value for getTime(): 10:00:00. Actual value: " . $lessonTime5->getTime() . "\n";//returning null since constructor didnt function
echo "Expected value for getLessonTimeID(): 1. Actual value: " . $lessonTime5->getLessonTimeID() . "\n";//returning null since constructor didnt function

echo "\n";
//missing array keys test
$lessonTime6 = new LessonTime(array("LessonTimeID" => 1, "Time" => "10:00:00"));//will generate error in code because of missing array key
echo "Expected value for getDay(): . Actual value: " . $lessonTime6->getDay() . "\n";//no array key in constructor so will return null
echo "Expected value for getTime(): 10:00:00. Actual value: " . $lessonTime6->getTime() . "\n";//array key in constructor so will return value
echo "Expected value for getLessonTimeID(): 1. Actual value: " . $lessonTime6->getLessonTimeID() . "\n";//array key in constructor so will return value

echo "\n";
//extra array keys test
$lessonTime7 = new LessonTime(array("LessonTimeID" => 1, "Day" => 1, "Time" => "10:00:00", "Extra" => "extra"));//will run and ignore extra array key
echo "Expected value for getDay(): 1. Actual value: " . $lessonTime7->getDay() . "\n";
echo "Expected value for getTime(): 10:00:00. Actual value: " . $lessonTime7->getTime() . "\n";
echo "Expected value for getLessonTimeID(): 1. Actual value: " . $lessonTime7->getLessonTimeID() . "\n";
?>
