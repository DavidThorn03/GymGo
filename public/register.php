<?php include "templates/header.php"; ?>
<head>
    <title>Register</title>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<link href="css/register.css" rel="stylesheet">
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
                    <label>First Name</label>
                    <input type="text" class="form-control" placeholder="First Name" required>
                </div>
                <div class="form-group">
                    <label>Last Name</label>
                    <input type="text" class="form-control" placeholder="Last Name" required>
                </div>
                <div class="form-group">
                    <label>Date of Birth</label>
                    <input type="date" class="form-control" placeholder="Date of Birth" required>
                </div>
                <div class="form-group">
                    <label>Eircode</label>
                    <input type="text" class="form-control" placeholder="Eircode" required>
                </div>
                <div class="form-group">
                    <label>Phone Number</label>
                    <input type="tel" class="form-control" placeholder="Phone Number"/>
                    <input type="tel" id="phone" name="phone" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" required />
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control" placeholder="Email" required>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" placeholder="Password" required>
                </div>

                <button type="submit" class="btn main">Register</button>
            </form>
        </div>
    </div>
</div>

<?php include "templates/footer.php"; ?>
