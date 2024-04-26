<?php
require "templates/header.php";
require "../UserClasses/customer.php";
if(!isset($_SESSION['user'])) {
    header("Location: login.php");
}
if(isset($_POST["Logout"])) {
    session::logout();
}
$user = unserialize($_SESSION['user']);
?>
<section class="about_section layout_padding">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="detail-box">
                    <div class="heading_container">
                        <h2>
                           Profile
                        </h2>
                    </div>
                    <p>
                        First Name: <?php echo $user->getFname(); ?>
                        <br>
                        <br>
                        Surname: <?php echo $user->getSname(); ?>
                        <br>
                        <br>
                        Email: <?php echo $user->getEmail(); ?>
                        <br>
                        <br>
                        Workout Badge: <?php echo $user->getBadge(); ?>
                        <br>
                        <br>
                        Date of Birth: <?php echo $user->getDOB(); ?>
                        <br>
                        <br>
                        Eircode: <?php echo $user->getEirCode(); ?>
                        <br>
                        <br>
                        Phone: <?php echo $user->getPhone(); ?>
                    </p>
                </div>
            </div>
            <div class="col-md-6">
                <a href="update-Profile.php" class="btn btn-primary">Update Profile</a>
                <br>
                <br>
                <br>
                <br>
                <br>
                <form method="post">
                    <button name="Logout" class="btn btn-primary" value="Logout">Logout</button>
                </form>
            </div>
        </div>
        <!-- Back to Home link -->
        <a href="index.php" class="btn btn-primary">Back to Home</a>
    </div>
</section>
<?php include "templates/footer.php"; ?>
