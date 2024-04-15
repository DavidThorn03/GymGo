<?php include "adminLoginHeader.php"; ?>
<?php
require ('../../dbQueries/adminQueries.php');
require ('../../common.php');
if(isset($_POST['Submit'])) {
    $email = escape($_POST["email"]);
    $password = escape($_POST["password"]);
    $check = checkAdminLogin($email, $password);
    if($check) {
        $_SESSION['admin'] = $email;
        header("Location: adminIndex.php");
    }
    else{
        echo "User name or password incorrect";
    }
}
?>


<div class="container">
    <form action="" method="post" name="Login_Form" class="form-signin">
        <h2 class="form-signin-heading">Please sign in</h2>
        <label for="inputEmail" >Username</label>
        <input name="email" type="email" id="inputEmail" class="form-control" placeholder="email" required autofocus>
        <label for="inputPassword">Password</label>
        <input name="password" type="password" id="inputPassword" class="form-control" placeholder="password" required>
        <div class="checkbox">
            <label>
                <input type="checkbox" value="remember-me"> Remember me
            </label>
        </div>
        <button name="Submit" value="Login" class="button" type="submit">Sign in</button>
    </form>
</div>


<?php include "adminFooter.php"; ?>
