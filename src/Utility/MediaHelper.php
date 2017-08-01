<?php

namespace App\Utility;

use App\Controller\AppController;
use App\Form\SearchForm;

/**
 * MediaHelper
 * 
 * Provide objects related to media to controllers (ResultsController & MediaController).
 */
class MediaHelper extends AppController {

    public function initialize() {
        parent::initialize();

        $this->loadModel( 'MediaGenres' );
    }

    /**
     * Implementation of a singleton for searchFields. Static variables in
     * functions are only initialized in the first call of the function for PHP.
     *
     * @return instance of searchFields
     */
    protected static function searchFieldsInstance() {
        static $searchFields = null;
        if ( $searchFields === null ) {
            $searchFields = new SearchForm();
        }
        return $searchFields;
    }

    /**
     * Returns a list of the genres currently inside the MediaGenresTable
     * 
     * @staticvar Cake\ORM\Entity $genreList
     * @return Cake\ORM\Entity $genreList
     */
    protected function getGenreList() {
        static $genreList = null;
        if ( $genreList === null ) {
            $genreList = $this->MediaGenres->find( 'list', ['keyField' => 'genre_id',
                'valueField' => 'genre_name'] );
        }
        return $genreList;
    }

    /**
     * Use the selected genre id to retrieve the name
     * 
     * @param string $searchGenreId
     * @return string $genreName
     */
    protected function getGenreName( $searchGenreId ) {
        $genreName = null;
        //grab the actual name of the genre chosen
        $genre = $this->MediaGenres->find()->select( ['genre_name'] )->
                        where( ['genre_id' => $searchGenreId] )->toArray();
        foreach ( $genre as $genreNames ) {
            $genreName = $genreNames->genre_name;
        }
        return $genreName;
    }

    /**
     * Creates a modelless form for the search bar.
     * $genreList is an array of containing the names of genres that will
     * populate the drop down.
     */
    protected function searchBar() {
        $searchFields = MediaHelper::searchFieldsInstance();
        if ( $this->request->is( 'post' ) ) {
            if ( $searchFields->execute( $this->request->getData() ) ) {

                return $this->redirect( ['controller' => 'Results', 'action' => 'search',
                            '?' => ['searchQuery' => $this->request->data( 'search' ),
                                'searchGenre' => $this->request->data( 'dropDown' )]] );
            } else {
                // something went wrong with search.
            }
        }

        $genreList = $this->getGenreList();
        // send genreList to view.
        $this->set( compact( 'searchFields', 'genreList' ) );
    }

}
