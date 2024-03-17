<?php
class Product
{
    private $productID;
    private $productName;
    private $description;
    private $price;
    private $image;

    public function __construct($product){
        $this->productID = $product["ProductID"];
        $this->productName = $product["ProductName"];
        $this->description = $product["Description"];
        $this->price = $product["Price"];
        $this->image = $product["ImageLink"];
    }

    public function getProductID(){
        return $this->productID;
    }

    public function getProductName(){
        return $this->productName;
    }

    public function getDescription(){
        return $this->description;
    }

    public function getPrice(){
        return $this->price;
    }

    public function getImageLink(){
        return $this->image->getImageLink();
    }

    public function setImage($image){
        $this->image = $image;
    }

}
?>