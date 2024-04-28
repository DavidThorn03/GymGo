<?php
require "templates/header.php";
require "../dbQueries/userQueries.php";
require "../UserClasses/customer.php";
$user = unserialize($_SESSION['user']);
foreach ($_POST as $key => $value) {
    $_POST[$key] = escape($value);
}
if (isset($_POST['submit'])) {
    updateUser($_POST);
    $userNew = new Customer($user->getUserID(), $user->getEmail(), $user->getPassword(), $_POST['firstname'], $_POST['lastname'], $_POST['date_of_birth'], $_POST['eircode'], $_POST['phone']);
    $_SESSION['user'] = serialize($userNew);
    echo "<script>alert('Profile updated successfully')</script>";
    header("Location: profile.php");
}

?>
<div class="container">
    <h2>Update Profile Info</h2>
    <form method="post">
        <div class="form-group">
            <label>First Name</label>
            <input type="text" class="form-control" placeholder="First Name"  name="firstname" required>
        </div>
        <div class="form-group">
            <label>Last Name</label>
            <input type="text" class="form-control" placeholder="Last Name" name="lastname" required>
        </div>
        <div class="form-group">
            <label>Date of Birth</label>
            <input type="date" class="form-control" placeholder="Date of Birth" name="date_of_birth" required>
        </div>
        <div class="form-group">
            <label>Eircode</label>
            <input type="text" class="form-control" placeholder="Eircode" name="eircode" maxlength="7" required>
        </div>
        <div class="form-group">
            <label>Phone Number</label>
            <input type="tel" class="form-control" id="phone" name="phone" placeholder="0861239876" pattern="[0-9]{3}[0-9]{3}[0-9]{4}" required />
        </div>
        <input type="hidden" name="UserID" value="<?php echo $user->getUserID(); ?>">

        <input type="submit" name="submit" value="Submit">
    </form>
    <a href="index.php">Back to home</a>
</div>
<?php require "templates/footer.php"; ?>