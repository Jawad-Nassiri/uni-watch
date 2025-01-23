<?php


namespace model\entity;

class Admin_add_product extends BaseEntity {
    private $title;
    private $brand;
    private $description;
    private $price;
    private $color;
    private $photo;
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
    public function getPrice() {
        return $this->price;
    }

    public function setPrice($price){
        $this->price = $price;
    }

    public function getColor() {
        return $this->color;
    }

    public function setColor($color){
        $this->color = $color;
    }


    public function getPhoto() {
        return $this->photo;
    }

    public function setPhoto($photo){
        $this->photo = $photo;
    }


    public function getStock() {
        return $this->stock;
    }

    public function setStock($stock){
        $this->stock = $stock;
    }

}