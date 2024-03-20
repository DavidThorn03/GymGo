<?php require "templates/header.php"; ?>
    <!-- slider section -->
<?php
require_once('config.php'); // Include configuration
?>
    <title>Home page</title>
    </head>

    <body>
<div class="container">
    <div class="header clearfix">

        <h3 class="text-muted">Home page</h3>
    </div>

    <div class="mainarea">
        <?php
        // Check if the 'Username' key is set in the $_SESSION array
        if(isset($_SESSION['Username'])) {
            echo '<h1>Status: You are logged in as '.$_SESSION['Username'].'</h1>';
        } else {
            echo '<h1>Status: You are not logged in</h1>';
        }
        ?>

        <h1>Title</h1>


        <form action="logout.php" method="post" name="Logout_Form" class="form-signin">
            <button name="Submit" value="Logout" class="button" type="submit">Log out</button>
        </form>
    </div>







<?php require "templates/footer.php"; ?>