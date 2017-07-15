<?php

namespace App\Controller;

use App\Controller\AppController;
use App\Form\SearchForm;

class ResultsController extends AppController {

    public $paginate = [
        'limit' => 4
    ];

    public function index() {
        
    }

    public function initialize() {
        parent::initialize();
        $this->loadComponent('Paginator');
        $this->loadModel('Media');
    }

    public function search($searchTerm = null, $search = null) {//add $contact
        if ($search == null) {
            $search = new SearchForm();
        }
        // copy paste index code starting from is post to get search bar on view


        $results = $this->Media->find('all', [
            'conditions' => ['Media.type_id' => 1,
                'OR' => ['Media.media_title LIKE' => '%' . $searchTerm . '%',
                    'Media.media_desc LIKE' => '%' . $searchTerm . '%']
            ]
        ]);

        $this->set('results', $this->paginate($results));
        $this->set(compact('contact'));
    }

}
