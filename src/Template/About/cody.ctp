<?php

use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Core\Plugin;
use Cake\Datasource\ConnectionManager;
use Cake\Error\Debugger;
use Cake\Network\Exception\NotFoundException;
$this->layout = false;
?>
<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cody's About Page</title>
         <?= $this->Html->meta('icon') ?>

    </head>
    <body class="home">
        <header class="row">
            <p>My Name is Cody</p>
            <p>I like school </p>
          <?php echo $this->Html->image('IMG_1609.JPG', array('alt' => 'CakePHP', 'border' => '0', 'data-src' => 'holder.js/1x1')); ?>
                
        </header>
        
    </body>
</html>



