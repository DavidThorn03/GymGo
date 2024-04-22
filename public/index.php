<?php require "templates/header.php";
    $images = unserialize($_SESSION['images']);
    if(!isset($_SESSION['imageNum'])){
        $_SESSION['imageNum'] = 0;
    }
    if(isset($_GET['imageBtn'])){
        if($_GET['imageBtn'] == "<" && $_SESSION['imageNum'] > 0){
            $_SESSION['imageNum']--;
        }
        else if($_GET['imageBtn'] == ">" && $_SESSION['imageNum'] < count($images) - 1){
            $_SESSION['imageNum']++;
        }
        else if($_GET['imageBtn'] == "<" && $_SESSION['imageNum'] <= 0){
            $_SESSION['imageNum'] = count($images) - 1;
        }
        else if($_GET['imageBtn'] == ">" && $_SESSION['imageNum'] >= count($images) - 1){
            $_SESSION['imageNum'] = 0;
        }
    }
?>
    <section class="about_section layout_padding">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="detail-box">
                        <div class="heading_container">
                            <h2>
                                Welcome to GymGo
                            </h2>
                        </div>
                        <p>
                            Welcome to GymGo!
                            <br>
                            Here you can see information about the goods and services we offer, including lessons, and products which can be purchased or booked through our site.
                            Our goal is to make your fitness journey as easy and enjoyable as possible.
                        </p>
                        <a href="login.php">
                            Login here
                        </a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="img-box">
                        <img src="<?php echo $images[$_SESSION['imageNum']]->getImageLink()?>" alt="">
                    </div>
                    <form action="" method="get">
                        <input type="submit" name="imageBtn" class="btn btn-primary" value="<">
                        <?php for($num = 0; $num < 37; $num++){?> &nbsp; <?php } ?>
                        <input type="submit" name="imageBtn" class="btn btn-primary" value=">">
                    </form>
                </div>
            </div>
        </div>
    </section>
<?php require "templates/footer.php"; ?>