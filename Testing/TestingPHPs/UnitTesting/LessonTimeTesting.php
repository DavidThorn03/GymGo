<?php
require "../../BookingClasses/LessonTime.php";
$lessonTime1 = new LessonTime(array("LessonTimeID" => 1, "Day" => 1, "Time" => "10:00:00", "LessonID" => 1));
echo "Expected value for getDay(): 1. Actual value: " . $lessonTime1->getDay() . "<br>";
echo "Expected value for getTime(): 10:00:00. Actual value: " . $lessonTime1->getTime() . "<br>";
echo "Expected value for getLessonTimeID(): 1. Actual value: " . $lessonTime1->getLessonTimeID() . "<br>";
echo "Expected value for getLessonID(): 1. Actual value: " . $lessonTime1->getLessonID() . "<br>";

echo "<br>";

$lessonTime2 = new LessonTime(array("LessonTimeID" => 2, "Day" => 2, "Time" => "11:00:00", "LessonID" => 2));
echo "Expected value for getDay(): 2. Actual value: " . $lessonTime2->getDay() . "<br>";
echo "Expected value for getTime(): 11:00:00. Actual value: " . $lessonTime2->getTime() . "<br>";
echo "Expected value for getLessonTimeID(): 2. Actual value: " . $lessonTime2->getLessonTimeID() . "<br>";
echo "Expected value for getLessonID(): 2. Actual value: " . $lessonTime2->getLessonID() . "<br>";

echo "<br>";

$lessonTime3 = new LessonTime(array("LessonTimeID" => 3, "Day" => 3, "Time" => "12:00:00", "LessonID" => 3));
echo "Expected value for getDay(): 3. Actual value: " . $lessonTime3->getDay() . "<br>";
echo "Expected value for getTime(): 12:00:00. Actual value: " . $lessonTime3->getTime() . "<br>";
echo "Expected value for getLessonTimeID(): 3. Actual value: " . $lessonTime3->getLessonTimeID() . "<br>";
echo "Expected value for getLessonID(): 3. Actual value: " . $lessonTime3->getLessonID() . "<br>";

echo "<br>";

$lessonTime4 = new LessonTime(array("LessonTimeID" => 4, "Day" => 4, "Time" => "13:00:00", "LessonID" => 4));
echo "Expected value for getDay(): 4. Actual value: " . $lessonTime4->getDay() . "<br>";
echo "Expected value for getTime(): 13:00:00. Actual value: " . $lessonTime4->getTime() . "<br>";
echo "Expected value for getLessonTimeID(): 4. Actual value: " . $lessonTime4->getLessonTimeID() . "<br>";
echo "Expected value for getLessonID(): 4. Actual value: " . $lessonTime4->getLessonID() . "<br>";
?>




