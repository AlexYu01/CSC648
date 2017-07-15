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
        $search = new SearchForm();
        if ($this->request->is('post')) {
            if ($search->execute($this->request->getData())) {
                $searchTerm = $this->request->data('search');
                $searchGenre = $this->request->data('dropDown');

                return $this->redirect(['controller' => 'Results', 'action' => 'search', $searchTerm, $search]);
            } else {
                // something went wrong with search.
            }
        }

        //$genreList = $this->MediaGenres->find()->select(['genre_name'])->toArray();
        $genreList = $this->MediaGenres->find('list', ['keyField' => 'genre_id',
                            'valueField' => 'genre_name'])
                        ->hydrate(false)->toArray();
        $this->set(compact('search', 'genreList'));
    }

}
