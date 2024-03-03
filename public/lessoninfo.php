<?php
    include "templates/header.php";
    require "../dbQueries/bookingQueries.php";
    $lesson1 = getLessonInfo(1);
?>
<h2>Lesson 1</h2>
    <ul>
        <li>Name: <?php echo $lesson1["LessonName"]?></li>
        <li>Duration: <?php echo $lesson1["DurationMin"]?> Minutes</li>
        <li>Number of Places: <?php echo $lesson1["NumPlaces"]?></li>
        <li>Trainer: <?php echo $lesson1["Trainer"]?></li>
        <li>About: <?php echo $lesson1["About"]?></li>
        <li>Image(Link): <?php echo $lesson1["ImageLink"]?></li>
    </ul>
<?php include "templates/footer.php"; ?>
