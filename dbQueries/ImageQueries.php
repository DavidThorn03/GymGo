<?php
function getImages(){
    try {
        require "../config.php";
        try {
            $connection = new PDO($dsn, $username, $password, $options);
        }
        catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }

        $sql = "SELECT * FROM Image";

        $statement = $connection->prepare($sql);
        $statement->execute();

        $result = $statement->fetchAll();

        return $result;
        echo "Image";
    }
    catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}
?>