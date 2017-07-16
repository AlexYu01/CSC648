<?php

namespace App\Controller;

use App\Controller\AppController;


class HomepageController extends AppController {

    public function initialize() {
        parent::initialize();
    }

    public function index() {
        $searchFields = new SearchForm();
        $this->searchBar($searchFields); // inherited from AppController
    }
}
