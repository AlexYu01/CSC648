<?php

namespace App\Controller;

use App\Utility\MediaHelper;

class HomepageController extends MediaHelper {

    public function initialize() {
        parent::initialize();
    }

    public function index() {

        $this->searchBar(); // inherited from MediaHelper
    }

}
