<?php

namespace App\Controller;

use App\Utility\MediaHelper;
use Cake\Network\Exception\NotFoundException;

class ResultsController extends MediaHelper {

    // limit 4 results per page
    public $paginate = [
        'limit' => 4
    ];

    public function index() {
        
    }

    public function initialize() {
        parent::initialize();
        $this->loadComponent( 'Paginator' );
        $this->loadModel( 'Media' );
    }

    public function search() {

        $this->searchBar(); // inherited from MediaHelper
        $searchTerm = $this->request->getQuery( 'searchQuery' );
        $searchGenre = $this->request->getQuery( 'searchGenre' );
        $results = null;

        $queryResults = $this->returnedResults( $searchTerm, $searchGenre );
        $results = $queryResults['results'];
        $resultReport = $queryResults['resultReport'];

        // fills in search fields with user's input on results page
        if ( $this->request->is( 'get' ) ) {
            $this->request->data( 'search', $searchTerm );
            $this->request->data( 'dropDown', $searchGenre );
        }

        $this->set( compact( 'resultReport' ) );
        try {
            // send results as paginated to view
            $this->set( 'results', $this->paginate( $results ) );
        } catch ( NotFoundException $e ) {
            // user tried accessing a page that does not exist or run search
            // on a page > 1
            return $this->redirect( ['controller' => 'Results', 'action' => 'search'] );
        }
    }

    private function returnedResults( $searchTerm, $searchGenre ) {
        $genreName = null;
        //grab the actual name of the genre chosen
        $genre = $this->MediaGenres->find()->select( ['genre_name'] )->
                        where( ['genre_id' => $searchGenre] )->toArray();
        foreach ( $genre as $genreNames ) {
            $genreName = $genreNames->genre_name;
        }

        // use the ternary operator ?: to determine if genreName is null if 
        // true then set genreName to 'all genres'.
        $genreName = $genreName ?: 'all genres';
        $validTerm = $searchTerm ?: 'all media';

        // user searched with either genre and/or a term.
        $results = $this->Media
                ->find( 'all' )
                ->where( ['type_id' => 1, 'OR' => [['media_title LIKE' => '%' . $searchTerm . '%'],
                        ['media_desc LIKE' => '%' . $searchTerm . '%']]] )
                ->where( ['genre_id LIKE' => '%' . $searchGenre . '%'],
                ['genre_id' => 'string'] );

        /* Note: Raw query equivalent (SELECT and INNER JOIN is performed later
         * after results is returned).
         * SELECT media_id, media_title, upload_date, media_link, price,
         *      media_desc, u.username
         * FROM media INNER JOIN users u ON u.user_id = author_id
         * WHERE type_id = 1 AND CONVERT(genre_id, CHAR) LIKE %$searchGenre% AND
         * (media_title LIKE %$searchTerm% OR media_desc LIKE %$searchTerm%);
         */

        if ( !($results->isEmpty()) ) {
            $resultReport = 'Displaying results for \'' . $validTerm . '\' under ' . $genreName . '.';
        } else {
            $results = $this->defaultResults( $searchGenre );
            $resultReport = 'There were no results for \'' . $validTerm . '\'. Here are some top sellers under ' . $genreName . '.';
        }

        // Added on query at the end for all search results.
        $results->select( ['media_id', 'media_title', 'upload_date',
                    'media_link', 'media_desc', 'u.username'] )
                ->join( [
                    'table' => 'users',
                    'alias' => 'u',
                    'type' => 'INNER',
                    'conditions' => 'u.user_id = Media.author_id',
                ] );

        return ['results' => $results, 'resultReport' => $resultReport];
    }

    /**
     * user search yielded no results. Give them top sellers in the genre they 
     * chose (if applicable).
     *
     * @param string $searchGenre
     * @return Cake\ORM\Entity $results
     */
    private function defaultResults( $searchGenre ) {
        $results = $this->Media
                ->find( 'all' )
                ->where( ['type_id' => 1] )
                ->where( ['genre_id LIKE' => '%' . $searchGenre . '%'],
                        ['genre_id' => 'string'] )
                ->order( ['sold_count' => 'DESC'] );

        /* Note: Raw query equivalent (SELECT and INNER JOIN is performed later
         * after results is returned.
         *
         * SELECT media_id, media_title, upload_date, media_link, price,
         *      media_desc, u.username
         * FROM media INNER JOIN users u ON u.user_id = author_id
         * WHERE type_id = 1 AND CONVERT(genre_id, CHAR) LIKE %$searchGenre%
         * ORDER BY Media.sold_count DESC;
         *
         */

        return $results;
    }

}
