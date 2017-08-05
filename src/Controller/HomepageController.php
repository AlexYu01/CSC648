<?php

namespace App\Controller;

class HomepageController extends AppController {

    public $paginate = [
        'limit' => 6
    ];

    public function initialize() {
        parent::initialize();
        $this->loadComponent( 'MediaHelper' );
    }

    public function index() {

        $this->MediaHelper->searchBar(); // inherited from MediaHelper

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
