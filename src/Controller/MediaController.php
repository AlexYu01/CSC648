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
    
    public function delete($id) {
        // allow authors to delete an entry
    }
    
    public function edit($id) {
        // allow authors to update an entry
    }

    public function upload() {
        $newMedia = $this->Media->newEntity();
        if ( $this->request->is( 'post' ) ) {
            $searchGenreId = $this->request->data( 'genre_id' );
            $searchGenreName = $this->getGenreName($searchGenreId);
            
            $mediaName = $this->request->data['file']['name'];
            
            // path link that will be stored in the database
            $mediaPathLink = 'media/' . $searchGenreName . '/' . $mediaName;
            
            // the absolute path where the media will be stored
            $storedPath = WWW_ROOT . 'img/' . $mediaPathLink;

            if ( move_uploaded_file( $this->request->data['file']['tmp_name'],
                            $storedPath) ) {
                $this->request->data['media_link'] = $mediaPathLink;
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
        $genreList = $this->getGenreList();
        
        // temporary until authentication can grab user's id
        $userList = $this->Users->find( 'list',
                                ['keyField' => 'user_id',
                            'valueField' => 'username'] )
                        ->hydrate( false )->toArray();
        
        // temporary until file can be checked for video or image
        $typeList = $this->MediaTypes->find( 'list',
                                ['keyField' => 'type_id',
                            'valueField' => 'type_name'] )
                        ->hydrate( false )->toArray();

        $this->set( compact( 'genreList', 'newMedia', 'userList', 'typeList' ) );
    }

}
