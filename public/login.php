<?php include "templates/header.php"; ?>
<?php
require ('../dbQueries/userQueries.php');
require ('../UserClasses/customer.php');
if(isset($_POST['Submit'])) {
    $email = escape($_POST["email"]);
    $password = escape($_POST["password"]);
    $check = checkLogin($email, $password);
    if($check) {
        $userFromDB = getUserInfo($email);
        var_dump($userFromDB);
        $user = new Customer($userFromDB['UserID'], $email, $password, $userFromDB['Fname'], $userFromDB['Sname'], $userFromDB['DOB'], $userFromDB['EirCode'], $userFromDB['Phone']);
        $_SESSION['user'] = serialize($user);
        session::initialiseUserSessionItems($user->getUserID());
        header("Location: index.php");
    }
    else{
        echo "User name or password incorrect";
    }
}
?>

<!DOCTYPE html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../public/css/signin.css">
    <link rel="stylesheet" type="text/css" href="../public/css/stylesheet.css">
    <title>Sign in</title>
</head>

<html>
<body>
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
    <p>
        Not a member? <a href="register.php">Register Here</a>
    </p>
</div>
</body>
</html>


<?php include "../public/templates/footer.php"; ?>
