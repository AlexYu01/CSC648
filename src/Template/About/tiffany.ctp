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
        <title>Tiffany's About Page</title>
         <?= $this->Html->meta('icon') ?>
    <?= $this->Html->css('base.css') ?>
    <?= $this->Html->css('cake.css') ?>
    </head>
    <body class="home">
        <h1 style="text-align: center;">Tiffany's About Page</h1>
	<?php
	   echo "<body style='background-color:grey'>";
	   echo "<div align='center'>I am a Computer Science major at SFSU
	   <br>I will be graduating Summer 2017</div>";
	?>
    </body>
</html>

