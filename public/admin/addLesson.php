<?php require 'adminHeader.php';
require ('../../dbQueries/adminQueries.php');
require ('../../common.php');
if(isset($_POST['Submit'])) {
    $info = array();
    foreach($_POST as $input){
        $info[] = escape($input);
    }
    addLesson($info);
}
?>


<div class="container">
    <form action="" method="post" name="Login_Form" class="form-signin">
        <h2 class="form-signin-heading">Add Lesson</h2>
        <label for="LessonID" >Lesson ID</label>
        <input name="LessonID" type="number" id="LessonID" class="form-control" required>
        <label for="LessonName">Name</label>
        <input name="LessonName" type="text" id="LessonName" class="form-control" required>
        <label for="DurationMin" >Duration Minutes</label>
        <input name="DurationMin" type="number" id="DurationMin" class="form-control" required>
        <label for="NumPlaces">Number of places</label>
        <input name="NumPlaces" type="number" id="NumPlaces" class="form-control" required>
        <label for="Trainer" >Trainer</label>
        <input name="Trainer" type="text" id="Trainer" class="form-control" required>
        <label for="About">About</label>
        <input name="About" type="text" id="About" class="form-control" required>
        <label for="ImageID">Image ID</label>
        <input name="ImageID" type="number" id="ImageID" class="form-control">
        <button name="Submit" class="btn btn-primary" type="submit">Add Lesson</button>
    </form>
</div>

<?php require 'adminFooter.php'; ?>

