<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * Item Controller
 *
 *
 * @method \App\Model\Entity\Item[] paginate($object = null, array $settings = [])
 */
class ItemController extends AppController {

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index($id = null) {
        //If no media id receives redirect to home page
        $id = $this->request->getQuery('id');
        if ($id == null) {
            return $this->redirect(['controller' => 'Homepage', 'action' => 'index']);
        } else {
            $this->loadModel('Media');
            try {
                $item = $this->Media->get($id, [
                    'contain' => []
                ]);

                $this->set(compact('item'));
                $this->set('_serialize', ['item']);
            } catch (\Exception $exc) {
                $item = 'No Result Found';
                $this->set(compact('item'));
                $this->set('_serialize', ['item']);
            }

            $this->loadModel('Users');
            try {
                if ($item != 'No Result Found') {
                    $user = $this->Users->get($item->author_id, [
                        'contain' => []
                    ]);

                    $this->set(compact('user'));
                    $this->set('_serialize', ['user']);
                }
            } catch (\Exception $exc) {
                $item = 'No Result Found';
                $this->set(compact('user'));
                $this->set('_serialize', ['user']);
            }
        }
    }

    public function image() {

        //get image request
        $id = $this->request->getQuery('id');
        $resize = $this->request->getQuery('resize');

        $resize_verify = preg_match('/^([0-9]{1,4})x([0-9]{1,4})$/', $resize, $match);
        //if image < 500pixel no watermark
        if ($resize_verify && $match[1] < 500 && $match[2] < 500) {
                $watermark = false;
        } else {
            $watermark = true;
        }

        $this->loadModel('Media');
        try {
            $item = $this->Media->get($id, [
                'contain' => []
            ]);

            if ($item->media_link != null) {
                // Load the stamp and the photo to apply the watermark to
                $stamp = imagecreatefrompng('img/logos/Logomakr_211c5G.png');
                $im = imagecreatefromjpeg('img/' . $item->media_link);
                // Set the margins for the stamp and get the height/width of the stamp image
                $max_x = imagesx($im);
                $max_y = imagesy($im);

                // Copy the stamp image onto our photo using the margin offsets and the photo 
                // width to calculate positioning of the stamp. 
                if ($watermark == true) {
                    $counter = 1;
                    while ($counter < 9) {
                        imagecopy($im, $stamp, rand(10, intval($max_x)), rand(10, intval($max_y)), 0, 0, imagesx($stamp), imagesy($stamp));
                        $counter += 1;
                    }
                }

                // Check for resize            
                if ($resize_verify) {

                    $new_x = $match[1];
                    $new_y = $match[2];
                    $thumb_nail = imagecreatetruecolor($new_x, $new_y);
                    imagecopyresized($thumb_nail, $im, 0, 0, 0, 0, $new_x, $new_y, $max_x, $max_y);
                    $im = $thumb_nail;
                } else if ($resize >= 0.1 && $resize < 1) {
                    
                }
                // Output and free memory
                header('Content-type: image/png');

                imagejpeg($im, null, 50);
                imagedestroy($im);
                imagedestroy($stamp);
                if (!empty($thumb_nail)) {
                    imagedestroy($thumb_nail);
                }
            } else {
                
            }
        } catch (\Exception $exc) {
            
        }
    }

}
