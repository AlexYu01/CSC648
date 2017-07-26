<?php

namespace App\Utility;

use App\Controller\AppController;
use App\Form\SearchForm;

/**
 * MediaHelper
 * 
 * Provide objects related to media to controllers.
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
            $genreList = $this->MediaGenres->find( 'list',
                                ['keyField' => 'genre_id',
                            'valueField' => 'genre_name'] );
        }
        return $genreList;
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
