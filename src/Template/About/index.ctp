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
    </head>
    <body>
            <!--<div class="header-image"><?= $this->Html->image('cake.logo.svg') ?></div>-->
            <div class="header-title" style="margin-top: 15px;margin-left: 15px;">
                <?= $this->Html->link('Andy\'s About Page','/about/andy',['class' => 'button'])?>
                <?= $this->Html->link('Andrew\'s About Page','/about/andrew',['class' => 'button'])?>
            </div>        
    </body>
</html>


