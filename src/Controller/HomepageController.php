<?php

namespace App\Controller;

use App\Controller\AppController;


class HomepageController extends AppController {

    public function initialize() {
        parent::initialize();
    }

    public function index() {
        $searchFields = null;
        $this->searchBar($searchFields); // inherited from AppController
    }
}
