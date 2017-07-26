<?php

namespace App\Controller;

use App\Controller\AppController;

class MediaController extends AppController {

    public function initialize() {
        parent::initialize();
        $this->loadModel( 'Media' );
        $this->loadModel( 'Users' );
        $this->loadModel( 'MediaTypes' );
    }

    public function upload() {
        $newMedia = $this->Media->newEntity();
        if ( $this->request->is( 'post' ) ) {

            $genreName = null;
            //grab the actual name of the genre chosen
            $genre = $this->MediaGenres->find()->select( ['genre_name'] )->
                            where( ['genre_id' => $searchGenre] )->toArray();
            foreach ( $genre as $genreNames ) {
                $genreName = $genreNames->genre_name;
            }

            $mediaName = $this->request->data['file']['name'];
            $uploadPath = 'media/';
            $uploadFile = $uploadPath . $genreName . '/' . $mediaName;
            if ( move_uploaded_file( $this->request->data['file']['tmp_name'] ) ) {
                $this->request->data['media_link'] = $uploadFile;
            }

            //$mediaType = pathinfo( $mediaName, PATHINFO_EXTENSION );

            $newMedia = $this->Media->patchEntity( $newMedia,
                    $this->request->data );
            if ( $this->Media->save( $newMedia ) ) {
                $this->Flash->success( __( 'The media  has been saved.' ) );
            } else {
                $this->Flash->error( __( 'The media could not be saved. Please, try again.' ) );
            }
        }
        $genreList = $this->MediaGenres->find( 'list',
                                ['keyField' => 'genre_id',
                            'valueField' => 'genre_name'] )
                        ->hydrate( false )->toArray();
        $userList = $this->Users->find( 'list',
                                ['keyField' => 'user_id',
                            'valueField' => 'username'] )
                        ->hydrate( false )->toArray();
        $typeList = $this->MediaTypes->find( 'list',
                                ['keyField' => 'type_id',
                            'valueField' => 'type_name'] )
                        ->hydrate( false )->toArray();

        $this->set( compact( 'genreList', 'newMedia', 'userList', 'typeList' ) );
    }

}
