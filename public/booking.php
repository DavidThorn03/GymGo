<?php
    require "../dbQueries/bookingQueries.php";

    include "templates/header.php";

    $time = getLessonTime("Monday");

    foreach($time = $row){
?>
<h2>Booking</h2>
    <ul>

    </ul>

<?php include "templates/footer.php"; ?>
