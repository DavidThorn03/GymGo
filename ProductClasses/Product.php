<?php
class Product
{
    private $productID;
    private $productName;
    private $description;
    private $price;
    private $imageLink;

    public function __construct($product){
        $this->productID = $product["ProductID"];
        $this->productName = $product["ProductName"];
        $this->description = $product["Description"];
        $this->price = $product["Price"];
        $this->imageLink = $product["ImageLink"];
    }

    public function getProductID(){
        return $this->productID;
    }

    public function getProductName(){
        return $this->productName;
    }

    public function description(){
        return $this->description;
    }

    public function price(){
        return $this->price;
    }

    public function getImageLink(){
        return $this->imageLink;
    }


    public function setProductID($productID){
        $this->productID = $productID;
    }

    public function setProductName($productName){
        $this->productName = $productName;
    }

    public function description($description){
        $this->description = $description;
    }

    public function price($price){
        $this->price = $price;
    }

    public function setImageLink($imageLink){
        $this->imageLink = $imageLink;
    }

}
?>