<?php

namespace App\Controller;

use App\Utility\MediaHelper;


class HomepageController extends AppController {
	public function initialize() {
		parent::initialize ();
		
	}
	public function index() {
		
// 		$this->searchBar(); // inherited from AppController
		
		$this->loadModel ( 'MediaGenres' );
		$mgResults = $this->MediaGenres->find ( 'all' )->toArray ();
		$this->set ('genresData', $mgResults);
		// pr($mgResults);
		
		$this->loadComponent ( 'Paginator' );
		$this->loadModel ( 'Media' );
		$results = $this->Media->find ( 'all', [ 
				'conditions' => [ 
						'Media.type_id' => 1 
				] 
		] );
		
		$this->paginate = [ 
				'limit' => 6,
				'contain' => [ 
						'mediagenres'  
				] 
		];
		$images = $this->paginate ( $results );
		
		$this->set ( 'productData', $images );
	}
  
}
