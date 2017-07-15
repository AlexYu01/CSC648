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
        $this->loadModel('MediaGenres');
    }

    public function search($searchTerm = null, $search = null) {
        if ($search == null) {
            $search = new SearchForm();
        }
        
        if ($this->request->is('post')) {
            if ($search->execute($this->request->getData())) {
                $searchTerm = $this->request->data('search');
                $searchGenre = $this->request->data('dropDown');

                return $this->redirect(['controller' => 'Results', 'action' => 'search', $searchTerm, $search]);
            } else {
                // something went wrong with search.
            }
        }
       


        $results = $this->Media->find('all', [
            'conditions' => ['Media.type_id' => 1,
                'OR' => ['Media.media_title LIKE' => '%' . $searchTerm . '%',
                    'Media.media_desc LIKE' => '%' . $searchTerm . '%']
            ]
        ]);
        
        if ($results->isEmpty()) {
            $results = $this->Media->find('all', ['conditions' => ['Media.type_id' => 1]]);
        }

        $this->set('results', $this->paginate($results));
        $this->set(compact('contact'));
        
        
        $genreList = $this->MediaGenres->find('list', ['keyField' => 'genre_id',
                            'valueField' => 'genre_name'])
                        ->hydrate(false)->toArray();
        $this->set(compact('search', 'genreList'));
    }

}
