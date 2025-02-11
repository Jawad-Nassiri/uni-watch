<?php

namespace controller;

use controller\BaseController;

class HomeController extends BaseController {
    // home page method 
    public function index() {
        return $this->render('home.html.php');
    }

    // about page method 

    public function about() {
        return $this->render('about.html.php');
    }
}
