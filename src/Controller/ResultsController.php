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

    public function search($searchFields = null) {
        $this->searchBar($searchFields); // inherited from AppController
        $session = $this->request->session();
        $searchTerm = $session->read('searchTerm');
        $searchGenre = $session->read('searchGenre');

        if (strlen($searchGenre) > 0) {
            $results = $this->Media->find('all', [
                'conditions' => ['Media.type_id' => 1,
                    'Media.genre_id' => $searchGenre, 'OR' =>
                    ['Media.media_title LIKE' => '%' . $searchTerm . '%',
                        'Media.media_desc LIKE' => '%' . $searchTerm . '%']
                ]
            ]);
        } else {
            $results = $this->Media->find('all', [
                'conditions' => ['Media.type_id' => 1, 'OR' => 
                    ['Media.media_title LIKE' => '%' . $searchTerm . '%',
                        'Media.media_desc LIKE' => '%' . $searchTerm . '%']
                ]
            ]);
        }

        if ($this->request->is('get')) {
            $this->request->data('search', $searchTerm);
            $this->request->data('dropDown', $searchGenre);
        }

        if ($results->isEmpty()) {
            $results = $this->Media->find('all', ['conditions' =>
                ['Media.type_id' => 1]]);
        }

        $genreList = $this->MediaGenres->find('list', ['keyField' => 'genre_id',
                            'valueField' => 'genre_name'])
                        ->hydrate(false)->toArray();

        $this->set('results', $this->paginate($results));
    }

}
