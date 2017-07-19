<?php

namespace App\Controller;

use App\Controller\AppController;
use App\Form\SearchForm;
use Cake\Network\Exception\NotFoundException;

class ResultsController extends AppController {

    // limit 4 results per page
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

        // user searched with genre and a term
        if (strlen($searchGenre) > 0) {
            $results = $this->Media->find('all', [
                'conditions' => ['Media.type_id' => 1,
                    'Media.genre_id' => $searchGenre, 'OR' =>
                    ['Media.media_title LIKE' => '%' . $searchTerm . '%',
                        'Media.media_desc LIKE' => '%' . $searchTerm . '%']
                ]
            ]);

            /* Raw query form for above
             * SELECT *
             * FROM media
             * WHERE type_id = 1 AND genre_id = $searchGenre AND 
             * (media_title LIKE %$searchTerm% OR media_desc LIKE %$searchTerm%;
             */
            
        // user only entered a term
        } else {
            $results = $this->Media->find('all', [
                'conditions' => ['Media.type_id' => 1, 'OR' =>
                    ['Media.media_title LIKE' => '%' . $searchTerm . '%',
                        'Media.media_desc LIKE' => '%' . $searchTerm . '%']
                ]
            ]);

            /* Raw query form for above
             * SELECT *
             * FROM media
             * WHERE type_id = 1 AND 
             * (media_title LIKE %$searchTerm% OR media_desc LIKE %$searchTerm%;
             */
        }


        // User search returned empty. Give them top sellers under the genre 
        // they chose if applicable else return top sellers in all genres.
         
        if ($results->isEmpty()) {
            if (strlen($searchGenre) > 0) {
                $results = $this->Media->find('all', [
                    'conditions' => ['Media.type_id' => 1,
                        'Media.genre_id' => $searchGenre, 'OR' =>
                        ['Media.media_title LIKE' => '%' . $searchTerm . '%',
                            'Media.media_desc LIKE' => '%' . $searchTerm . '%']
                    ]
                ])
                        ->order(['Media.sold_count' => 'DSC']);
                
                /* Raw query form for above
                 * SELECT *
                 * FROM media
                 * WHERE type_id = 1 AND genre_id = $searchGenre
                 * ORDER BY Media.sold_count DESC;
                 */
            } else {
                $results = $this->Media->find('all', ['conditions' =>
                    ['Media.type_id' => 1]])
                        ->order(['Media.sold_count' => 'DSC']);

                /* Raw query form for above
                 * SELECT *
                 * FROM media
                 * WHERE type_id = 1
                 * ORDER BY Media.sold_count DESC;
                 */
            }
        }
        
        // fills in search fields with user's input on results page
        if ($this->request->is('get')) {
            $this->request->data('search', $searchTerm);
            $this->request->data('dropDown', $searchGenre);
        }

        try {
            // send results as paginated to view
            $this->set('results', $this->paginate($results));
        } catch (NotFoundException $e) {
            // user tried accessing a page that does not exist or run search 
            // on a page > 1
            return $this->redirect(['controller' => 'Results', 'action' => 'search']);
        }
    }

}
