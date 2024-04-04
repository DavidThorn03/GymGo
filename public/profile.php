<?php
include "templates/header.php";
if(!isset($_SESSION['user'])) {
    header("Location: login.php");
}
require_once '../dbQueries/userQueries.php';

?>
<a href="update-Profile.php">Update Profile</a>

<?php include "templates/footer.php"; ?>
