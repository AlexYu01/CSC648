<?php

namespace App\Controller;

use App\Controller\AppController;

class MediaController extends AppController {

    public function initialize() {
        parent::initialize();
        $this->loadModel( 'Media' );
        $this->loadModel( 'Users' );
        $this->loadModel( 'MediaTypes');
    }

    public function upload() {
        $newMedia = $this->Media->newEntity();
        if ( $this->request->is( 'post' ) ) {
            $mediaData = $this->request->data['file']['tmp_name'];
            $mediaContent = file_get_contents( $_FILES['file']['tmp_name'] );
            /*echo $mediaContent;
            echo $mediaData;
            echo gettype( $mediaData );*/
            $mediaType = pathinfo( $mediaData, PARTHINFO_EXTENSION );
            $this->request->data['media_data'] = $mediaContent;
            $this->request->data['media_ext'] = $mediaType;

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
