<?php require 'adminHeader.php';
if(isset($_POST['Logout'])){
    session::forgetSession();
    header("Location: ../index.php");
}
?>
<section class="about_section layout_padding">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="detail-box">
                    <div class="heading_container">
                        <h2>
                            <span>Admin Index</span>
                        </h2>
                    </div>

                        <a href="addLesson.php" class="apply-btn">Add Lesson</a>
                        <br>
                        <br>
                        <a href="addLessonTime.php" class="apply-btn">Add Lesson Time</a>
                        <br>
                        <br>
                        <a href="addProduct.php" class="apply-btn">Add Product</a>
                        <br>
                        <br>
                        <a href="deleteLesson.php" class="apply-btn">Delete Lesson</a>
                        <br>
                        <br>
                        <a href="deleteLessonTime.php" class="apply-btn">Delete Lesson Time</a>
                        <br>
                        <br>
                        <a href="deleteProduct.php" class="apply-btn">Delete Product</a>
                        <br>
                        <br>
                    <form method="post">
                        <button name="Logout" class="btn btn-primary" value="Logout">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require 'adminFooter.php'; ?>
