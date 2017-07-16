<?php

namespace App\Controller;

use App\Controller\AppController;
use App\Form\SearchForm;

use Cake\Network\Exception\NotFoundException;

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

    public function search() {
        $this->searchBar(); // inherited from AppController
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

	try {
        	$this->set('results', $this->paginate($results));
    	} catch (NotFoundException $e) {
	return $this->redirect(['controller' => 'Results', 'action' => 'search']);


        // Do something here like redirecting to first or last page.
        // $this->request->getParam('paging') will give you required info.
    }

}

}
