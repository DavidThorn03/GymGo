<?php
session_start();
$_SESSION['id'] = 2;
//require "../common.php";
require "../dbQueries/userQueries.php";
if (isset($_POST['submit'])) {
    updateUser($_POST);
    header("Location: profile.php");
}
    $user = getUserInfo($_SESSION['id']);

?>
<?php require "templates/header.php"; ?>

    <h2>Edit a user</h2>
    <form method="post">

        <?php foreach ($user as $key => $value) :
            if($key != "UserID"){?>
            <label for="<?php echo $key; ?>"> <?php echo ucfirst($key); ?> </label>
            <input type="text" name="<?php echo $key; ?>" id="<?php echo $key; ?>"
                   value="<?php echo escape($value); ?>">
            <?php echo ($key === 'id' ? 'readonly' : null); ?>
            <br>
        <?php }endforeach; ?>

        <input type="submit" name="submit" value="Submit">
    </form>
    <a href="index.php">Back to home</a>
<?php require "templates/footer.php"; ?>