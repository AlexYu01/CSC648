<?php

namespace App\Controller;

use App\Controller\AppController;
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

        $genreSelected = (!empty($searchGenre));
        $results = null;

        // user searched with genre and a term.
        if ($genreSelected) {
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

            if (!empty($searchTerm)) {
                $session->write('searchResults', 'Showing results for '
                        . $searchTerm . ' under ' . $searchGenre . '!');
            } else {
                $session->write('searchResults', 'Showing results under '
                        . $searchGenre . '!');
            }

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
             * (media_title LIKE %$searchTerm% OR media_desc LIKE %$searchTerm%);
             */
            $session->write('searchResults', 'Showing results for '
                    . $searchTerm . '!');
        }


        // User search term returned empty results. Give them top sellers under 
        // the genre they chose if applicable else return top sellers in all
        // genres.

        if ($results->isEmpty()) {
            if ($genreSelected) {
                $results = $this->Media->find('all', [
                            'conditions' => ['Media.type_id' => 1,
                                'Media.genre_id' => $searchGenre
                            ]
                        ])
                        ->order(['Media.sold_count' => 'DESC']);

                /* Raw query form for above
                 * SELECT *
                 * FROM media
                 * WHERE type_id = 1 AND genre_id = $searchGenre
                 * ORDER BY Media.sold_count DESC;
                 */
                $session->write('searchResults', 'There were no results for '
                        . $searchTerm . ' here are some top sellers under '
                        . $searchGenre . '!');
            } else {
                $results = $this->Media->find('all', ['conditions' =>
                            ['Media.type_id' => 1]])
                        ->order(['Media.sold_count' => 'DESC']);

                /* Raw query form for above
                 * SELECT *
                 * FROM media
                 * WHERE type_id = 1
                 * ORDER BY Media.sold_count DESC;
                 */
                $session->write('searchResults', 'There were no results for '
                        . $searchTerm . ' here are some top sellers!');
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
