<?php
function setConnection(){
    require "../../config.php";
    try {
        $connection = new PDO($dsn, $username, $password, $options);
        return $connection;
    } catch (\PDOException $e) {
        throw new \PDOException($e->getMessage(), (int)$e->getCode());
    }
}
function addLesson($lesson)
{
    try {
        $sql = "insert into lessons (LessonID, LessonName, DurationMin, NumPlaces, Trainer, About, ImageID) 
                VALUES (:LessonID, :LessonName, :DurationMin, :NumPlaces, :Trainer, :About, :ImageID)";
        $statement = setConnection()->prepare($sql);
        $statement->bindValue(':LessonID', $lesson[0]);
        $statement->bindValue(':LessonName', $lesson[1]);
        $statement->bindValue(':DurationMin', $lesson[2]);
        $statement->bindValue(':NumPlaces', $lesson[3]);
        $statement->bindValue(':Trainer', $lesson[4]);
        $statement->bindValue(':About', $lesson[5]);
        $statement->bindValue(':ImageID', $lesson[6]);
        $statement->execute();
    } catch (PDOException $error) {
        echo "Error: " . $error->getMessage();
    }
}

function addLessonTime($lessonTime)
{
    try {
        $sql = "insert into `lesson-time` (LessonTimeID, `Time`, `Day`, LessonID)
                VALUES (:LessonTimeID, :Time, :Day, :LessonID)";
        $statement = setConnection()->prepare($sql);
        $statement->bindValue(":LessonTimeID", $lessonTime[0]);
        $statement->bindValue(":Time", $lessonTime[1]);
        $statement->bindValue(":Day" , $lessonTime[2]);
        $statement->bindValue(":LessonID", $lessonTime[3]);
        $statement->execute();
    } catch (PDOException $error) {
        echo "Error: " . $error->getMessage();
    }
}

function addProduct($product){
    try {
        $sql = "INSERT INTO products (ProductID, ProductName, Price, Description, Size, Colour, ImageID) 
                VALUES (:ProductID, :ProductName, :Price, :Description, :Size, :Colour, :ImageID)";
        $statement = setConnection()->prepare($sql);
        $statement->bindValue(':ProductID', $product[0]);
        $statement->bindValue(':ProductName', $product[1]);
        $statement->bindValue(':Price', $product[2]);
        $statement->bindValue(':Description', $product[3]);
        $statement->bindValue(':Size', $product[4]);
        $statement->bindValue(':Colour', $product[5]);
        $statement->bindValue(':ImageID', $product[6]);
        $statement->execute();
    } catch (PDOException $error) {
        echo "Error: " . $error->getMessage();
    }
}

function deleteLesson($lessonID){
    try {
        $sql = "DELETE FROM lessons where LessonID = :LessonID";
        $statement = setConnection()->prepare($sql);
        $statement->bindValue(':LessonID', $lessonID);
        $statement->execute();
    } catch (PDOException $error) {
        echo "Error: " . $error->getMessage();
    }
}

function deleteLessonTime($lessonTimeID){
    try {
        $sql = "DELETE FROM `lesson-time` where LessonTimeID = :LessonTimeID";
        $statement = setConnection()->prepare($sql);
        $statement->bindValue(':LessonTimeID', $lessonTimeID);
        $statement->execute();
    } catch (PDOException $error) {
        echo "Error: " . $error->getMessage();
    }
}

function deleteProduct($productID){
    try {
        $sql = "DELETE FROM products where ProductID = :ProductID";
        $statement = setConnection()->prepare($sql);
        $statement->bindValue(':ProductID', $productID);
        $statement->execute();
    } catch (PDOException $error) {
        echo "Error: " . $error->getMessage();
    }
}
function checkAdminLogin($email, $userpassword){
    try {
        $sql = "select `user`.`Password` from `user` inner join `admin` on `user`.UserID = `admin`.UserID where email = :email";
        $statement = setConnection()->prepare($sql);
        $statement->bindValue(':email', $email);
        $statement->execute();
        $user = $statement->fetch(PDO::FETCH_ASSOC);
        if($user == false){
            return false;
        }
        else {
            if (password_verify($userpassword, $user['Password'])) {
                return true;
            }
            else {
                return false;
            }
        }
    } catch (PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}