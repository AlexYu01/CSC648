<?php

use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Core\Plugin;
use Cake\Datasource\ConnectionManager;
use Cake\Error\Debugger;
use Cake\Network\Exception\NotFoundException;

$this->layout = 'default_no_menu';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Custom Page</title>
        <?= $this->Html->meta( 'icon' ) ?>
        <?= $this->Html->css( 'bootstrap' ) ?>
        <link href="https://fonts.googleapis.com/css?family=Raleway:500i|Roboto:300,400,700|Roboto+Mono" rel="stylesheet">
    </head>
    <body>
            <!--<div class="header-image"><?= $this->Html->image( 'cake.logo.svg' ) ?></div>-->
        <div class="header-title text-center" style="margin-top: 15px;margin-left: 15px;">                
            <?php
            echo $this->Html->link( 'Andy\'s About Page', ['controller' => 'About',
                'action' => 'andy'], ['class' => 'btn btn-info'] );

            echo $this->Html->link( 'Calvin\'s About Page', ['controller' => 'About',
                'action' => 'calvin'], ['class' => 'btn btn-info'] );

            echo $this->Html->link( 'Haotian\'s About Page', ['controller' => 'About',
                'action' => 'haotian'], ['class' => 'btn btn-info'] );

            echo $this->Html->link( 'Teng\'s About Page', ['controller' => 'About',
                'action' => 'teng'], ['class' => 'btn btn-info'] );

            echo $this->Html->link( 'Cody\'s About Page', ['controller' => 'About',
                'action' => 'cody'], ['class' => 'btn btn-info'] );

            echo $this->Html->link( 'Tiffany\'s About Page', ['controller' => 'About',
                'action' => 'tiffany'], ['class' => 'btn btn-info'] );

            echo $this->Html->link( 'Andrew\'s About Page', ['controller' => 'About',
                'action' => 'andrew'], ['class' => 'btn btn-info'] );
            ?>
        </div>  
    </body>
</html>


