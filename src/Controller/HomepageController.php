<?php

namespace App\Controller;

use App\Utility\MediaHelper;

class HomepageController extends MediaHelper {

    public $paginate = [
        'limit' => 6
    ];

    public function initialize() {
        parent::initialize();
    }

    public function index() {

        $this->searchBar(); // inherited from MediaHelper

        $this->loadComponent( 'Paginator' );
        $this->loadModel( 'Media' );
        $results = $this->Media->find( 'all', [
            'conditions' => [
                'Media.type_id' => 1
            ]
                ] );

        $images = $this->paginate( $results );

        $this->set( 'productData', $images );
    }

}
