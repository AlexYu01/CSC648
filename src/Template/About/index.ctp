<?php

use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Core\Plugin;
use Cake\Datasource\ConnectionManager;
use Cake\Error\Debugger;
use Cake\Network\Exception\NotFoundException;
//$this->layout = false;
?>
<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Custom Page</title>
        
         <?= $this->Html->meta('icon') ?>
        <link href="https://fonts.googleapis.com/css?family=Raleway:500i|Roboto:300,400,700|Roboto+Mono" rel="stylesheet">
        <link rel="stylesheet" href="css/searchBar.css"/>
        <script type="text/javascript"></script>
        
    <a href="http://sfsuse.com/~ip/"><?= $this->Html->image("Logomakr_211c5G",array('width'=> '200px', 'height'=>'250px')) ?></a>
    </head>
    <body>
        <!--
            Created a search bar and search button
        -->
        <div style="width:400px; margin-right:auto; margin-left:auto; margin-top:15px;">
        <form action="search.php" method="post" id="search">
            <select id="categoryList" name="Category">
                <option value="all">All</option>
                <option value="pictures">Pictures</option>
                <option value="videos">Videos</option>
            </select>
            <input type="text" id="searchBar" placeholder="Enter keywords here..." maxlength="30" autocomplete="off" onMouseDown="" onblur=""/>
            <input  type="submit" id="searchButton" value="Search!"/>
        </form>
        </div>
            <!--<div class="header-image"><?= $this->Html->image('cake.logo.svg') ?></div>-->
            <div class="header-title" style="margin-top: 15px;margin-left: 15px;">
                <?= $this->Html->link('Andy\'s About Page','/about/andy',['class' => 'button'])?>
		<?= $this->Html->link('Calvin\'s About Page','/about/calvin',['class' => 'button'])?>
                <?= $this->Html->link('Register','/about/registration',['class' => 'link'])?>
</div>
	    
	            
    </body>
</html>


