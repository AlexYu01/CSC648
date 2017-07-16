<?php

namespace App\Controller;

use App\Controller\AppController;
use App\Form\SearchForm;

class HomepageController extends AppController {

    public function initialize() {
        parent::initialize();
        $this->loadModel('MediaGenres');
    }

    public function index() {
        $this->searchBar();
    }
}
