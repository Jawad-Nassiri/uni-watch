<?php

namespace controller;

abstract class BaseController{

    public function render($file, array $array = []){
        extract($array);

        include "public/header.html.php";
        include "view/$file";
        include "public/footer.html.php"; 
    }
}
