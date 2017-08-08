<?php

namespace App\Controller;

class MediaController extends AppController {

    /**
     * Initialization hook method.
     *
     * @return void
     */
    public function initialize() {
        parent::initialize();
        $this->loadModel( 'Media' );

        $this->loadComponent( 'MediaHelper' );
    }

    public $paginate = [
        'limit' => 15
    ];

    /**
     * Delete individual media post owned by user from database and remove files from filesystem.
     * 
     * @param string|null $id Media id.
     * @return \Cake\Http\Response|null Redirects to posts.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete( $id = null) {
        $this->request->allowMethod( ['post', 'delete'] );

        $media = $this->Media->get( $id );
        if ( $this->Media->delete( $media ) ) {

            unlink( WWW_ROOT . 'img/' . $media['media_link'] );
            if ( $media['thumb_link'] != null ) {
                unlink( WWW_ROOT . 'img/' . $media['thumb_link'] );
            }
            $this->Flash->success( __( 'Your media post has been deleted.' ) );
            return $this->redirect( ['action' => 'posts'] );
        }
        $this->Flash->error( __( 'Unable to delete your media post.' ) );
    }

    /**
     * View individual media post owned by user.
     *
     * @param string|null $id Media id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view( $id = null ) {
        $userMedia = $this->Media->get( $id );
        $this->set( compact( 'userMedia' ) );
    }

    /**
     * View all media posts owned by user.
     * 
     * @return \Cake\Http\Response|void
     */
    public function posts() {
        $userProducts = $this->Media->find( 'all' )
                ->where( ['author_id' => $this->Auth->user( 'user_id' )] );
        $this->set( 'userProducts', $this->paginate( $userProducts ) );
    }

    /**
     * Edit media post owned by user.
     * 
     * @param string|null $id Media id.
     * @return \Cake\Http\Response|null Redirects on successful edit.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit( $id = null ) {
        // allow authors to update an entry
        $userMedia = $this->Media->get( $id );
        if ( $this->request->is( ['post', 'put'] ) ) {
            $this->Media->patchEntity( $userMedia, $this->request->getData() );
            if ( $this->Media->save( $userMedia ) ) {
                $this->Flash->success( __( 'Your post has been updated.' ) );
                return $this->redirect( ['action' => 'view', $id] );
            }
            $this->Flash->error( __( 'Unable to update your post.' ) );
        }

        $genreList = $this->MediaHelper->getGenreList();
        $this->set( compact( 'genreList', 'userMedia' ) );
    }

    /**
     * Allow registered users to upload video or image to sell.
     *
     * @return \Cake\Http\Response|null Redirects on successful add.
     */
    public function add() {
        $newMedia = $this->Media->newEntity();

        if ( $this->request->is( 'post' ) ) {

            $input = $this->request->data;
            if ( isset( $input['file']['name'] ) ) {
                $input['author_id'] = $this->Auth->user( 'user_id' );

                $genreId = $input['genre_id'];
                $genreName = strtolower( $this->MediaHelper->getGenreName( $genreId ) );

                $mediaName = strtolower( $input['file']['name'] );

                // Truncate file name to last 100 characters if it exceeds 150. DB only stores up to 150 chars for links.
                $mediaName = (strlen( $mediaName ) > 150) ? substr( $mediaName, -100 ) : $mediaName;

                // add "unique" string to the name of the file to avoid over writes
                $mediaStoredName = uniqid( '', true ) . '-' . $mediaName;

                // path link for full image that will be stored in the database
                $mediaPathLink = 'media/' . $genreName . '/' . $mediaStoredName;

                // the absolute path where the uploaded media will be moved to
                $storedPath = WWW_ROOT . 'img/' . $mediaPathLink;

                $input['media_link'] = $mediaPathLink;

                $finfo = finfo_open();
                $mime = strtolower( finfo_file( $finfo, $input['file']['tmp_name'], FILEINFO_MIME ) );
                finfo_close( $finfo );

                if ( strstr( $mime, 'image/' ) ) {
                    // path link for thumbnail that will be stored in the database
                    // use a different uniqid to avoid users from changing url link to access full image
                    $mediaThumbLink = 'media/' . $genreName . '/' . uniqid( 'thumbnail-' ) . '-' . $mediaName;
                    $input['type_id'] = 1; // image
                    $input['thumb_link'] = $mediaThumbLink;

                    $newMedia = $this->Media->patchEntity( $newMedia, $input );

                    if ( $this->Media->save( $newMedia ) ) {
                        // generate and store thumbnail. Also move uploaded file
                        $this->generateThumbnail( $input['file']['tmp_name'], $mediaThumbLink );
                        move_uploaded_file( $input['file']['tmp_name'], $storedPath );
                    } else {
                        $this->Flash->error( __( 'The picture could not be uploaded. Please, try again.' ) );
                    }
                } else {
                    $input['type_id'] = 2; // video
                    $newMedia = $this->Media->patchEntity( $newMedia, $input );

                    if ( $this->Media->save( $newMedia ) ) {
                        move_uploaded_file( $input['file']['tmp_name'], $storedPath );
                    } else {
                        $this->Flash->error( __( 'The video could not be uploaded. Please, try again.' ) );
                    }
                }
                // return $this->redirect( ['controller' => 'Media', 'action' => 'view', $newMedia->media_id] );
            }
        }
        $genreList = $this->MediaHelper->getGenreList();

        $this->set( compact( 'genreList', 'newMedia' ) );
    }

    /**
     * Generate a thumbnail for images to store in filesystem.
     *
     * @return \Cake\Http\Response|null Redirects on successful add.
     */
    private function generateThumbnail( $source, $mediaThumbLink ) {
        $nw = 400;
        $nh = 400;
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

    /**
     * Allow registered users to access add or posts method. Allow media owners to view, edit or delete their posts.
     * 
     * 
     * @param type $user
     * @return boolean
     */
    public function isAuthorized( $user ) {

        if ( in_array( $this->request->getParam( 'action' ), ['add', 'posts'] ) ) {
            return true;
        }

        if ( in_array( $this->request->getParam( 'action' ), ['view', 'edit', 'delete'] ) ) {
            $mediaId = (int) $this->request->getParam( 'pass.0' );
            if ( $this->Media->isOwnedBy( $mediaId, $user['user_id'] ) ) {
                return true;
            }
        }

        return parent::isAuthorized( $user );
    }

}
