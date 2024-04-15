<?php require 'adminHeader.php';
require ('../../dbQueries/adminQueries.php');
require ('../../common.php');
if(isset($_POST['Submit'])) {
    $info = array();
    foreach($_POST as $input){
        $info[] = escape($input);
    }
    addLessonTime($info);
    header("Location: adminIndex.php");
}
?>


<div class="container">
    <form action="" method="post" name="Login_Form" class="form-signin">
        <h2 class="form-signin-heading">Add Lesson Time</h2>
        <label for="LessonTimeID" >Lesson Time ID</label>
        <input name="LessonTimeID" type="number" id="LessonTimeID" class="form-control" required>
        <label for="Time">Time</label>
        <input name="Time" type="time" id="Time" class="form-control" required>
        <label for="Day" >Day</label>
        <input name="Day" type="number" id="Day" class="form-control" required>
        <label for="LessonID">Lesson ID</label>
        <input name="LessonID" type="number" id="LessonID" class="form-control" required>
        <button name="Submit" class="button" type="submit">Add Lesson Time</button>
    </form>
</div>



<?php require 'adminFooter.php'; ?>

