<?php

namespace controller;

use controller\BaseController;

class HomeController extends BaseController {
    public function index() {
        return $this->render('home.html.php');
    }
}
