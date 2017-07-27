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

    public function delete( $id ) {
        // allow authors to delete an entry
        $this->request->allowMethod( ['post', 'delete'] );

        $media = $this->Media->get( $id );
        if ( $this->Media->delete( $media ) ) {
            unlink( WWW_ROOT . 'img/' . $media['media_link'] );
            unlink( WWW_ROOT . 'img/' . $media['thumb_link'] );
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
            $mediaStoredName = uniqid() . $mediaName;

            // path link for full image that will be stored in the database
            $mediaPathLink = 'media/' . $searchGenreName . '/' . $mediaStoredName;

            // path link for thumbnail that will be stored in the database
            $mediaThumbLink = 'media/' . $searchGenreName . '/' . 'thumbnail-' . $mediaStoredName;

            // the absolute path where the media will be stored
            $storedPath = WWW_ROOT . 'img/' . $mediaPathLink;

            $this->request->data['media_link'] = $mediaPathLink;
            $this->request->data['thumb_link'] = $mediaThumbLink;

            $newMedia = $this->Media->patchEntity( $newMedia,
                    $this->request->getData() );

            if ( $this->Media->save( $newMedia ) ) {
                move_uploaded_file( $this->request->data['file']['tmp_name'],
                        $storedPath );
                $this->generateThumbnail( $this->request->data['file']['tmp_name'],
                        $mediaThumbLink );
            } else {
                unlink( WWW_ROOT . 'img/' . $mediaThumbLink );
                $this->Flash->error( __( 'The media could not be saved. Please, try again.' ) );
            }
            return $this->redirect('');
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

    private function generateThumbnail( $source, $mediaThumbLink ) {
        $nw = 300;
        $nh = 300;
        $imageInfo = getimagesize( $source );
        $w = $imageInfo[0];
        $h = $imageInfo[1];
        $type = $imageInfo['mime'];

        switch ( $type ) {
            case 'image/gif':
                $simg = imagecreatefromgif( $source );
                break;
            case 'image/jpg':
                $simg = imagecreatefromjpeg( $source );
                break;
            case 'image/png':
                $simg = imagecreatefrompng( $source );
                break;
            default:
                $simg = imagecreatefromjpeg( $source );
        }

        $dimg = imagecreatetruecolor( $nw, $nh );

        $wm = $w / $nw;
        $hm = $h / $nh;

        $h_height = $nh / 2;
        $w_height = $nw / 2;

        if ( $w > $h ) {

            $adjusted_width = $w / $hm;
            $half_width = $adjusted_width / 2;
            $int_width = $half_width - $w_height;

            imagecopyresampled( $dimg, $simg, -$int_width, 0, 0, 0,
                    $adjusted_width, $nh, $w, $h );
        } elseif ( ($w < $h) || ($w == $h) ) {
            $adjusted_height = $h / $wm;
            $half_height = $adjusted_height / 2;
            $int_height = $half_height - $h_height;
            imagecopyresampled( $dimg, $simg, 0, -$int_height, 0, 0, $nw,
                    $adjusted_height, $w, $h );
        } else {
            imagecopyresampled( $dimg, $simg, 0, 0, 0, 0, $nw, $nh, $w, $h );
        }

        $dest = WWW_ROOT . 'img/' . $mediaThumbLink;
        imagejpeg( $dimg, $dest, 100 );

        imagedestroy( $simg );
        imagedestroy( $dimg );
    }

}
