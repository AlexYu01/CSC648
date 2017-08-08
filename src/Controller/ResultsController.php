<?php

namespace App\Controller;

use Cake\Network\Exception\NotFoundException;

class ResultsController extends AppController {

    // limit 4 results per page
    public $paginate = [
        'limit' => 30
    ];

    /**
     * Initialization hook method.
     *
     * @return void
     */
    public function initialize() {
        parent::initialize();
        $this->loadComponent( 'Paginator' );
        $this->loadModel( 'Media' );
        $this->loadComponent( 'MediaHelper' );
    }

    /**
     * Retrieve user inputs for SQL query
     * 
     * @return Cake\ORM\Entity $results
     */
    public function search() {

        $this->MediaHelper->searchBar();
        $searchTerm = $this->request->getQuery( 'searchQuery' );
        $searchGenreId = $this->request->getQuery( 'searchGenre' );
        $results = null;

        $queryResults = $this->returnedResults( $searchTerm, $searchGenreId );
        $results = $queryResults['results'];
        $resultReport = $queryResults['resultReport'];

        // fills in search fields with user's input on results page
        if ( $this->request->is( 'get' ) ) {
            $this->request->data( 'search', $searchTerm );
            $this->request->data( 'dropDown', $searchGenreId );
        }

        $this->set( compact( 'resultReport' ) );
        try {
            $this->set( 'results', $this->paginate( $results ) );
        } catch ( NotFoundException $e ) {
            // user tried accessing a page that does not exist or run search
            // on a page > 1
            return $this->redirect( ['controller' => 'Results', 'action' => 'search'] );
        }
    }

    /**
     * Retrieve entries that match user inputs.
     * 
     * @param string $searchTerm
     * @param string $searchGenreId
     * @return string $resultReport
     * @return Cake\ORM\Entity $results
     */
    private function returnedResults( $searchTerm, $searchGenreId ) {
        $searchGenreName = $this->MediaHelper->getGenreName( $searchGenreId );

        // use the ternary operator ?: to determine if searchGenreName is null if 
        // true then set searchGenreName to 'all genres'.

        $searchGenreName = $searchGenreName ?: 'all genres';
        $validTerm = $searchTerm ?: 'all media';

        // user searched with either genre and/or a term.
        $results = $this->Media
                ->find( 'all' )
                ->where( ['OR' => [['media_title LIKE' => '%' . $searchTerm . '%'],
                ['media_desc LIKE' => '%' . $searchTerm . '%']]] );

        if ( $searchGenreId != null ) {
            $results->where( ['genre_id' => $searchGenreId] );
        }

        /* Note: Raw query equivalent (SELECT and INNER JOIN is performed later
         * after results is returned).
         * 
         * if searchGenreId is null then genre_id = genre_id returns all genres
         * 
         * SELECT media_id, media_title, upload_date, media_link, price,
         *      media_desc, u.username
         * FROM media INNER JOIN users u ON u.user_id = author_id
         * WHERE genre_id = $searchGenreId AND (media_title LIKE %$searchTerm% OR media_desc LIKE %$searchTerm%);
         */

        if ( !($results->isEmpty()) ) {
            $resultReport = 'Displaying results for \'' . $validTerm . '\' under ' . $searchGenreName . '.';
        } else {
            $results = $this->defaultResults( $searchGenreId );
            $resultReport = 'There were no results for \'' . $validTerm . '\'. Here are some top sellers under ' . $searchGenreName . '.';
        }

        // Added on query at the end for all search results.
        $results->select( ['media_id', 'media_title', 'upload_date',
                    'media_link', 'thumb_link', 'media_desc', 'u.username'] )
                ->join( [
                    'table' => 'users',
                    'alias' => 'u',
                    'type' => 'INNER',
                    'conditions' => 'u.user_id = Media.author_id'
                ] );

        return ['results' => $results, 'resultReport' => $resultReport];
    }

    /**
     * User search yielded no results. Give them top sellers in the genre they 
     * chose (if applicable).
     *
     * @param string $searchGenre
     * @return Cake\ORM\Entity $results
     */
    private function defaultResults( $searchGenreId ) {
        $results = $this->Media->find( 'all' );
        if ( $searchGenreId != null ) {
            $results->where( ['genre_id' => $searchGenreId] );
        }
        $results->order( ['sold_count' => 'DESC'] );

        /* Note: Raw query equivalent (SELECT and INNER JOIN is performed later
         * after results is returned.
         *
         * SELECT media_id, media_title, upload_date, media_link, price,
         *      media_desc, u.username
         * FROM media INNER JOIN users u ON u.user_id = author_id
         * WHERE genre_id = $searchGenreId
         * ORDER BY Media.sold_count DESC;
         *
         */

        return $results;
    }

}
