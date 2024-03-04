<?php
    include "templates/header.php";
    require "../dbQueries/bookingQueries.php";

    $lessons = getLessonInfo(1);
?>
<h2>Lesson 1</h2>
    <ul>
        <li>Name: <?php echo $lessons["LessonName"]?></li>
        <li>Duration: <?php echo $lessons["DurationMin"]?> Minutes</li>
        <li>Number of Places: <?php echo $lessons["NumPlaces"]?></li>
        <li>Trainer: <?php echo $lessons["Trainer"]?></li>
        <li>About: <?php echo $lessons["About"]?></li>
        <li>Image(Link): <?php echo $lessons["ImageLink"]?></li>
    </ul>
<?php include "templates/footer.php"; ?>
