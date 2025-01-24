<?php


namespace model\entity;

class Admin_add_product extends BaseEntity {
    private $title;
    private $brand;
    private $description;
    private $image;
    private $price;
    private $stock;


    public function getTitle() {
        return $this->title;
    }

    public function setTitle($title){
        $this->title = $title;
    }

    public function getBrand() {
        return $this->brand;
    }

    public function setBrand($brand){
        $this->brand = $brand;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setDescription($description){
        $this->description = $description;
    }

    public function getImage() {
        return $this->image;
    }

    public function setImage($image){
        $this->image = $image;
    }
    public function getPrice() {
        return $this->price;
    }

    public function setPrice($price){
        $this->price = $price;
    }


    public function getStock() {
        return $this->stock;
    }

    public function setStock($stock){
        $this->stock = $stock;
    }

}