<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

class AboutController extends AppController {
    
    /**
     * Initialization hook method.
     *
     * @return void
     */
    public function initialize() {
        parent::initialize();
    }

    public function index() {
        
    }

    public function andy() {
        
    }

    public function calvin() {
        
    }
    
    public function andrew() {
        
    }
    
    public function cody() {
        
    }
    
    public function haotian() {
        
    }
    
    public function teng() {
        
    }
    
    public function tiffany() {
        
    }
    
    public function beforeFilter( Event $event ) {
        parent::beforeFilter($event);
        $this->Auth->allow( ['index', 'andy', 'calvin','andrew', 'cody','haotian', 'teng','tiffany'] );
    }

}
