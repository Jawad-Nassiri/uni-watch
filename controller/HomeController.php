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

    // term & privacy method 
    public function terms_privacy () {
        return $this->render('terms&privacy.html.php');
    }
}
