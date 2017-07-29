<?php

namespace App\Controller;

use App\Utility\MediaHelper;

class MediaController extends MediaHelper {

    public function initialize() {
        parent::initialize();
        $this->loadModel( 'Media' );
        // temporary until authentication is done
        $this->loadModel( 'Users' );
        // temporary until checks for file type is implemented
        $this->loadModel( 'MediaTypes' );
    }

    public function index() {
        // all posts an author has
    }
    public function delete( $id ) {
        // allow authors to delete an entry
        $this->request->allowMethod( ['post', 'delete'] );

        $article = $this->Media->get( $id );
        if ( $this->Media->delete( $article ) ) {
            unlink( WWW_ROOT . 'img/' . $article['media_link'] );
            $this->Flash->success( __( 'The article with id: {0} has been deleted.',
                            h( $id ) ) );
            return $this->redirect( ['controller' => 'Results', 'action' => 'search'] );
        }
    }

    public function edit( $id ) {
        // allow authors to update an entry
    }

    public function add() {
        $newMedia = $this->Media->newEntity();

        if ( $this->request->is( 'post' ) ) {

            $searchGenreId = $this->request->data( 'genre_id' );
            $searchGenreName = strtolower( $this->getGenreName( $searchGenreId ) );

            $mediaName = $this->request->data['file']['name'];

            // path link that will be stored in the database
            $mediaPathLink = 'media/' . $searchGenreName . '/' . $mediaName;

            // the absolute path where the media will be stored
            $storedPath = WWW_ROOT . 'img/' . $mediaPathLink;

            //$mediaType = pathinfo( $mediaName, PATHINFO_EXTENSION );

            $newMedia = $this->Media->patchEntity( $newMedia,
                    $this->request->getData() );

            $newMedia->media_link = $mediaPathLink;
            //$newMedia->author_id = $this->Auth->user( 'id' );

            if ( $this->Media->save( $newMedia ) ) {
                move_uploaded_file( $this->request->data['file']['tmp_name'],
                        $storedPath );
            } else {
                $this->Flash->error( __( 'The media could not be saved. Please, try again.' ) );
            }
            return $this->redirect( ['action' => 'add'] );
        }
        $genreList = $this->getGenreList();

        // temporary until authentication can grab user's id
        $userList = $this->Users->find( 'list',
                ['keyField' => 'user_id', 'valueField' => 'username'] );

        // temporary until file can be checked for video or image
        $typeList = $this->MediaTypes->find( 'list',
                ['keyField' => 'type_id', 'valueField' => 'type_name'] );

        $this->set( compact( 'genreList', 'newMedia', 'userList', 'typeList' ) );
    }

}
