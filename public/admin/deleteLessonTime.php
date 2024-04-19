<?php require 'adminHeader.php';
require ('../../dbQueries/adminQueries.php');
require ('../../common.php');
if(isset($_POST['Submit'])) {
    $lessonTimeID = escape($_POST["LessonTimeID"]);
    deleteLessonTime($lessonTimeID);
}
?>

<div class="container">
    <form action="" method="post" name="Login_Form" class="form-signin">
        <h2 class="form-signin-heading">Delete Lesson Time</h2>
        <label for="LessonTimeID" >Lesson Time ID</label>
        <input name="LessonTimeID" type="number" id="LessonTimeID" class="form-control" required>
        <button name="Submit" class="button" type="submit">Delete Lesson Time</button>
    </form>
</div>



<?php require 'adminFooter.php'; ?>

