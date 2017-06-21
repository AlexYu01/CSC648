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
    <style>
        .featurette
        {
            text-align: center;
            font-size: 25px;
        }
    </style>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> Calvin's About Page </title>
        <?= $this->Html->css('base.css') ?>
    </head>
    <body>
        <header style="text-align: center">
            <h1>Calvin's About Page</h1>
        </header>
        <div class="featurette">
            <p style="align-content: center">
                Hey there, my name is Calvin Ip and I am a CS major at San Francisco State University.
            </p>
            
            <p>
                <?= $this->Html->image("Okinawa",array('width'=> '500px', 'height'=>'250px')) ?>
            </p>
            
        </div>
    </body>
</html>
