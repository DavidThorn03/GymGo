<?php
require "templates/header.php";
require "../dbQueries/userQueries.php";
require "../UserClasses/customer.php";
$user = unserialize($_SESSION['user']);
if (isset($_POST['submit'])) {
    updateUser($_POST);
    $userNew = new Customer($user->getUserID(), $user->getEmail(), $user->getPassword(), $_POST['Fname'], $_POST['Sname'], $_POST['DOB'], $_POST['EirCode'], $_POST['Phone']);
    $_SESSION['user'] = serialize($userNew);
    header("Location: profile.php");
}

?>

    <h2>Update Profile Info</h2>
    <form method="post">
        <label for="Fname"> First name </label>
            <br>
        <input type="text" name="Fname" id="Fname"
               value="<?php echo $user->getFname(); ?>">
            <br>
            <br>

        <label for="Sname"> Surname</label>
            <br>
        <input type="text" name="Sname" id="Sname"
               value="<?php echo $user->getSname(); ?>">
            <br>
            <br>

        <label for="DOB"> Date of Birth</label>
            <br>
        <input type="text" name="DOB" id="DOB"
               value="<?php echo $user->getDOB(); ?>">
            <br>
            <br>

        <label for="EirCode"> EirCode</label>
            <br>
        <input type="text" name="EirCode" id="EirCode"
               value="<?php echo $user->getEirCode(); ?>">
            <br>
            <br>

        <label for="Phone"> Phone</label>
            <br>
        <input type="text" name="Phone" id="Phone"
               value="<?php echo $user->getPhone(); ?>">
            <br>
            <br>
        <input type="hidden" name="UserID" value="<?php echo $user->getUserID(); ?>">

        <input type="submit" name="submit" value="Submit">
    </form>
    <a href="index.php">Back to home</a>
<?php require "templates/footer.php"; ?>