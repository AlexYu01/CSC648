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


        $searchTerm = $this->request->getQuery('searchQuery');
        $searchGenre = $this->request->getQuery('searchGenre');

        $genreSelected = (!empty($searchGenre));
        $searchTermExist = (!empty($searchTerm));
        $results = null;



        if (preg_match('/[[:digit:][:punct:]]+/', $searchTerm) == 1) {
            $this->Flash->success('Invalid string');
        } else {
            $this->Flash->success('Valid String');
        }

        // user searched with genre and a term.
        //if ($genreSelected) {
            /*$results = $this->Media->find('all', ['conditions' =>
                ['type_id' => 1, 'genre_id' => $searchGenre,
                    'OR' => ['media_title LIKE' =>
                        '%' . $searchTerm . '%', 'media_desc LIKE' =>
                        '%' . $searchTerm . '%']]]);*/
            
            $results = $this->Media->find('all')->where(['type_id' => 1, 'OR' => [['media_title LIKE' => '%' . $searchTerm . '%'], ['media_desc LIKE' => '%' . $searchTerm . '%']]])->where(['genre_id LIKE' => '%'.$searchGenre.'%'], ['genre_id' => 'string']);


            /* Raw query form for above(part of the query is towards the bottom
             * of search)
             * SELECT media_id, media_title, upload_date, media_link, price,
             *      media_desc, u.username
             * FROM media INNER JOIN users u ON u.user_id = author_id
             * WHERE type_id = 1 AND genre_id = $searchGenre AND
             * (media_title LIKE %$searchTerm% OR media_desc LIKE %$searchTerm%;
             */

            //grab the actual name of the genre chosen
            $genre = $this->MediaGenres->find()->select(['genre_name'])->
                            where(['genre_id' => $searchGenre])->toArray();

            foreach ($genre as $genreNames) {
                $genreName = $genreNames->genre_name;
            }

            if ($searchTermExist) {
                if ($genreSelected) {
                $searchResults = 'Showing results for \'' . $searchTerm .
                        '\' under \'' . $genreName . '\'';
                } else {
                    $searchResults = 'Showing results for \'' . $searchTerm . '\'';
                } 
            } else {
                if ($genreSelected) {
                $searchResults = 'Showing results under \'' . $genreName . '\'';
                } else {
                    $searchResults = 'Showing all media';
                }
            }



            // user only entered a term
        //} else {
           /* $results = $this->Media->find('all', ['conditions' =>
                ['type_id' => 1, 'OR' => ['media_title LIKE' =>
                        '%' . $searchTerm . '%', 'media_desc LIKE' =>
                        '%' . $searchTerm . '%']]]);*/

            
            /* Raw query form for above(part of the query is towards the bottom
             * of search())
             * SELECT media_id, media_title, upload_date, media_link, price,
             *      media_desc, u.username
             * FROM media INNER JOIN users u ON u.user_id = author_id
             * WHERE type_id = 1 AND
             * (media_title LIKE %$searchTerm% OR media_desc LIKE %$searchTerm%);
             */

            /*if ($searchTermExist) {
                $searchResults = 'Showing results for \'' . $searchTerm . '\'';
            } else {
                $searchResults = 'Showing all media';
            }*/
        //}



        // User search term returned empty results. Give them top sellers under
        // the genre they chose if applicable else return top sellers in all
        // genres.

        if ($results->isEmpty()) {
            if ($genreSelected) {
                $results = $this->Media->find('all', ['conditions' =>
                            ['type_id' => 1, 'genre_id' => $searchGenre]])
                        ->order(['sold_count' => 'DESC']);

                /* Raw query form for above(part of the query is towards the
                 * bottom of search())
                 * SELECT media_id, media_title, upload_date, media_link, price,
                 *      media_desc, u.username
                 * FROM media INNER JOIN users u ON u.user_id = author_id
                 * WHERE type_id = 1 AND genre_id = $searchGenre
                 * ORDER BY Media.sold_count DESC;
                 */

                $searchResults = 'There were no results for \'' . $searchTerm .
                        '\'. Here are some top sellers under \'' . $genreName .
                        '\'';



                // user did not select a genre and term did not match anything
            } else {
                $results = $this->Media->find('all', ['conditions' =>
                            ['type_id' => 1]])
                        ->order(['sold_count' => 'DESC']);

                /* Raw query form for above(part of the query is towards the
                 * bottom)
                 * SELECT media_id, media_title, upload_date, media_link, price,
                 *      media_desc, u.username
                 * FROM media INNER JOIN users u ON u.user_id = author_id
                 * WHERE type_id = 1
                 * ORDER BY Media.sold_count DESC;
                 */

                $searchResults = 'There were no results for \'' . $searchTerm .
                        '\'. Here are some top sellers';
            }
        }



        /* Added on query at the end for all queries. Having it here rather than
         * four different areas of the if-else statement queries. */

        $results->select(['media_id', 'media_title', 'upload_date',
                    'media_link', 'media_desc', 'u.username'])
                ->join([
                    'table' => 'users',
                    'alias' => 'u',
                    'type' => 'INNER',
                    'conditions' => 'u.user_id = Media.author_id',
        ]);



        // fills in search fields with user's input on results page
        if ($this->request->is('get')) {
            $this->request->data('search', $searchTerm);
            $this->request->data('dropDown', $searchGenre);
        }


        $this->set(compact('searchResults'));
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
