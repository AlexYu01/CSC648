<?php

namespace App\Controller\Component;

use Cake\Controller\Component;
use App\Form\SearchForm;

/**
 * MediaHelper
 * 
 * Provide access to functions that are used by two or more controllers
 */
class MediaHelperComponent extends Component {

    public function initialize( array $config ) {
        //$this->controller is the controller using the component class
        $this->controller = $this->_registry->getController();
        $this->controller->loadModel( 'MediaGenres' );
    }

    /**
     * Implementation of a singleton for searchFields. Static variables in
     * functions are only initialized in the first call of the function for PHP.
     *
     * @return instance of searchFields
     */
    public static function searchFieldsInstance() {
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
    public function getGenreList() {
        static $genreList = null;
        if ( $genreList === null ) {
            $genreList = $this->controller->MediaGenres->find( 'list', ['keyField' => 'genre_id',
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
    public function getGenreName( $searchGenreId ) {
        $genreName = null;
        //grab the actual name of the genre chosen
        $genre = $this->controller->MediaGenres->find()->select( ['genre_name'] )->
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
    public function searchBar() {
        $searchFields = MediaHelperComponent::searchFieldsInstance();
        if ( $this->request->is( 'post' ) ) {
            if ( $searchFields->execute( $this->request->getData() ) ) {

                return $this->controller->redirect( ['controller' => 'Results', 'action' => 'search',
                            '?' => ['searchQuery' => $this->request->data( 'search' ),
                                'searchGenre' => $this->request->data( 'dropDown' )]] );
            } else {
                // something went wrong with search.
            }
        }

        $genreList = $this->getGenreList();
        // send genreList to view.
        $this->controller->set( compact( 'searchFields', 'genreList' ) );
    }

}
