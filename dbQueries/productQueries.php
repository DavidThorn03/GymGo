<?php

function getProducts(){
    try {
        require "../config.php";
        try {
            $connection = new PDO($dsn, $username, $password, $options);
        }
        catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }

        $sql = "SELECT * FROM products"; 

        $statement = $connection->prepare($sql);
        $statement->execute();

        $result = $statement->fetchAll();
        return $result;
    }
    catch(PDOException $error){
        echo $sql . "<br>" . $error->getMessage();
    }
}

function submitOrder($userID, $productID, $orderTime){
    try {
        require "../config.php";
        try {
            $connection = new PDO($dsn, $username, $password, $options);
        }
        catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }

        $sql = "INSERT INTO orders (UserID, ProductID, OrderTime) VALUES (:userID, :productID, :orderTime)";

        $statement = $connection->prepare($sql);
        $statement->bindValue(':userID', $userID, PDO::PARAM_INT);
        $statement->bindValue(':productID', $productID, PDO::PARAM_INT);
        $statement->bindValue(':orderTime', $orderTime, PDO::PARAM_STR);
        $statement->execute();
    } catch (PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}

?>