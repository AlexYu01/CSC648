<?php

/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */

namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use App\Form\SearchForm;
use Cake\Validation\Validator;

$validator = new Validator();
/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link http://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize() {
        parent::initialize();

        $this->loadComponent( 'RequestHandler' );
        $this->loadComponent( 'Flash' );

        $this->loadModel( 'MediaGenres' );

        /*
         * Enable the following components for recommended CakePHP security settings.
         * see http://book.cakephp.org/3.0/en/controllers/components/security.html
         */
        //$this->loadComponent('Security');
        //$this->loadComponent('Csrf');
    }

    /**
     * Before render callback.
     *
     * @param \Cake\Event\Event $event The beforeRender event.
     * @return \Cake\Network\Response|null|void
     */
    public function beforeRender( Event $event ) {
        if ( !array_key_exists( '_serialize', $this->viewVars ) &&
                in_array( $this->response->type(),
                        ['application/json', 'application/xml'] )
        ) {
            $this->set( '_serialize', true );
        }
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
     * Creates a modelless form for the search bar.
     * $genreList is an array of containing the names of genres that will
     * populate the drop down.
     */
    public function searchBar() {
        $searchFields = AppController::searchFieldsInstance();
        if ( $this->request->is( 'post' ) ) {
            if ( $searchFields->execute( $this->request->getData() ) ) {

                return $this->redirect( ['controller' => 'Results', 'action' => 'search',
                            '?' => ['searchQuery' => $this->request->data( 'search' ),
                                'searchGenre' => $this->request->data( 'dropDown' )]] );
            } else {
                // something went wrong with search.
            }
        }

        $genreList = $this->MediaGenres->find( 'list',
                                ['keyField' => 'genre_id',
                            'valueField' => 'genre_name'] )
                        ->hydrate( false )->toArray();
        // send genreList to view.
        $this->set( compact( 'searchFields', 'genreList' ) );
    }

}
