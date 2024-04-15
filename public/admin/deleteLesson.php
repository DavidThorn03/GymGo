<?php require 'adminHeader.php';
require ('../../dbQueries/adminQueries.php');
require ('../../common.php');
if(isset($_POST['Submit'])) {
    $lessonID = escape($_POST["LessonID"]);
    deleteLesson($lessonID);
    header("Location: adminIndex.php");
}
?>

<div class="container">
    <form action="" method="post" name="Login_Form" class="form-signin">
        <h2 class="form-signin-heading">Delete Lesson</h2>
        <label for="LessonID" >Lesson ID</label>
        <input name="LessonID" type="number" id="LessonID" class="form-control" required>
        <button name="Submit" class="button" type="submit">Delete Lesson</button>
    </form>
</div>



<?php require 'adminFooter.php'; ?>

