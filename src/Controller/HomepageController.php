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

                $this->Flash->success($searchGenre);
                return $this->redirect(['controller' => 'Results', 'action' => 'search', $searchTerm, $search]);
            } else {
                // something went wrong with search.
            }
        }

        $genreList = $this->MediaGenres->find('list')->toArray();
        $this->set(compact('search', 'genreList'));
    }

}
