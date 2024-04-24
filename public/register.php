<?php include "templates/header.php";
require "../UserClasses/customer.php";
if(isset($_POST['register'])){
    require_once '../dbQueries/userQueries.php';
    $email = escape($_POST['email']);
    if(!emailExists($email) > 0){
        if(isset($_SESSION['user'])){
            session::logout();
        }
        $firstname = escape($_POST['firstname']);
        $lastname = escape($_POST['lastname']);
        $date_of_birth = escape($_POST['date_of_birth']);
        $eircode = escape($_POST['eircode']);
        $phone = escape($_POST['phone']);
        $userpassword = escape($_POST['password']);
        $user = new Customer(null, $email, $userpassword, $firstname, $lastname, $date_of_birth, $eircode, $phone);
        $userID = createUser($user);
        $user->setUserID($userID);
        $_SESSION['user'] = serialize($user);
        echo "<script>alert('Registered successfully')</script>";
        $_SESSION['BookedLessons'] = serialize(array());
        header("Location: profile.php");
    }
    else{
        echo "<script>alert('Email already exists. Please use a different email')</script>";
    }
}
?>


<form action="" method="post">

    <head>
        <title>Register</title>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <!------ Include the above in your HEAD tag ---------->
        <link rel="stylesheet" type="text/css" href="../css/register.css">
    </head>

    <div class="sidenav">
        <div class="login-main-text">
            <h2>Registration Page</h2>
        </div>
    </div>
    <div class="main">
        <div class="col-md-6 col-sm-12">
            <div class="login-form">
                <form>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" placeholder="Email"  name="email" required>
                    </div>
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
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Password" required />
                    </div>

                    <button type="submit" class="btn btn-primary" name="register">Register</button>
                </form>
            </div>
        </div>
    </div>

    <?php include "templates/footer.php"; ?>