<?php

namespace App\Controller;

class MediaController extends AppController {

    public function initialize() {
        parent::initialize();
        $this->loadModel( 'Media' );

        $this->loadComponent( 'MediaHelper' );
    }
    
    public function delete( $id ) {
        // allow authors to delete an entry
        $this->request->allowMethod( ['post', 'delete'] );

        $media = $this->Media->get( $id );
        if ( $this->Media->delete( $media ) ) {
            // remove files from filesystem
            unlink( WWW_ROOT . 'img/' . $media['media_link'] );
            if ( $media['thumb_link'] != null ) {
                unlink( WWW_ROOT . 'img/' . $media['thumb_link'] );
            }
            return $this->redirect( ['action' => 'posts'] );
        }
    }
    
    public function view( $id ) {
        //$id = $this->request->getQuery( 'id' );
        $userProduct = $this->Media->get( $id );
        $this->set( compact( 'userProduct' ) );
    }

    public function posts() {
        $userProducts = $this->Media->find( 'all' )
                ->where( ['author_id' => $this->Auth->user( 'user_id' )] );
        $this->set( compact( 'userProducts' ) );
    }

    public function edit( $id ) {
        //$id = $this->request->getQuery( 'id' );
        // allow authors to update an entry
    }

    public function add() {
        $newMedia = $this->Media->newEntity();

        if ( $this->request->is( 'post' ) ) {

            $input = $this->request->data;
            $input['author_id'] = $this->Auth->user( 'user_id' );

            $searchGenreId = $input['genre_id'];
            $searchGenreName = strtolower( $this->MediaHelper->getGenreName( $searchGenreId ) );

            $mediaName = strtolower( $input['file']['name'] );

            // add "unique" string to the name of the file to avoid over writes
            $mediaStoredName = uniqid() . '-' . $mediaName;

            // path link for full image that will be stored in the database
            $mediaPathLink = 'media/' . $searchGenreName . '/' . $mediaStoredName;

            // the absolute path where the media will be stored
            $storedPath = WWW_ROOT . 'img/' . $mediaPathLink;

            $input['media_link'] = $mediaPathLink;

            $finfo = finfo_open();
            $mime = strtolower( finfo_file( $finfo, $input['file']['tmp_name'], FILEINFO_MIME ) );
            finfo_close( $finfo );

            if ( strstr( $mime, 'image/' ) ) {
                // path link for thumbnail that will be stored in the database
                $mediaThumbLink = 'media/' . $searchGenreName . '/' . 'thumbnail-' . $mediaStoredName;
                $input['type_id'] = 1;
                $input['thumb_link'] = $mediaThumbLink;

                $newMedia = $this->Media->patchEntity( $newMedia, $input );

                if ( $this->Media->save( $newMedia ) ) {
                    // generate and store thumbnail it. Also store uploaded file
                    $this->generateThumbnail( $input['file']['tmp_name'], $mediaThumbLink );
                    move_uploaded_file( $input['file']['tmp_name'], $storedPath );
                } else {
                    //$this->Flash->error( __( 'The media could not be saved. Please, try again.' ) );
                }
                // redirect to view later
                return $this->redirect( ['action' => 'posts'] );
            } else {
                $input['type_id'] = 2;
                $newMedia = $this->Media->patchEntity( $newMedia, $input );

                if ( $this->Media->save( $newMedia ) ) {
                    move_uploaded_file( $input['file']['tmp_name'], $storedPath );
                } else {
                    //$this->Flash->error( __( 'The media could not be saved. Please, try again.' ) );
                }
                // redirect to view later
                return $this->redirect( ['action' => 'posts'] );
            }
        }

        $genreList = $this->MediaHelper->getGenreList();


        $this->set( compact( 'genreList', 'newMedia' ) );
    }

    private function generateThumbnail( $source, $mediaThumbLink ) {
        $nw = 300;
        $nh = 300;
        $imageInfo = getimagesize( $source );
        $w = $imageInfo[0];
        $h = $imageInfo[1];

        $type = strtolower( $imageInfo['mime'] );

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

            imagecopyresampled( $dimg, $simg, -$int_width, 0, 0, 0, $adjusted_width, $nh, $w, $h );
        } elseif ( ($w < $h) || ($w == $h) ) {
            $adjusted_height = $h / $wm;
            $half_height = $adjusted_height / 2;
            $int_height = $half_height - $h_height;
            imagecopyresampled( $dimg, $simg, 0, -$int_height, 0, 0, $nw, $adjusted_height, $w, $h );
        } else {
            imagecopyresampled( $dimg, $simg, 0, 0, 0, 0, $nw, $nh, $w, $h );
        }

        $dest = WWW_ROOT . 'img/' . $mediaThumbLink;

        switch ( $type ) {
            case 'image/gif':
                imagegif( $dimg, $dest );
                break;
            case 'image/jpg':
                imagejpeg( $dimg, $dest, 100 );
                break;
            case 'image/png':
                imagepng( $dimg, $dest, 0 );
                break;
            default:
                imagejpeg( $dimg, $dest, 100 );
        }

        imagedestroy( $simg );
        imagedestroy( $dimg );
    }

    public function isAuthorized( $user ) {
        // All registered users can add articles

        if ( in_array( $this->request->getParam( 'action' ), ['add', 'posts'] ) ) {
            return true;
        }

        // The owner of an article can edit and delete it
        if ( in_array( $this->request->getParam( 'action' ), ['view', 'edit', 'delete'] ) ) {
            $mediaId = (int) $this->request->getParam( 'pass.0' );
            //$mediaId = (int) $this->request->getQuery( 'id' );
            if ( $this->Media->isOwnedBy( $mediaId, $user['user_id'] ) ) {
                return true;
            }
        }

        return parent::isAuthorized( $user );
    }

}
