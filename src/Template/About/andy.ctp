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
        <title>Andy's About Page</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
         <?= $this->Html->meta('icon') ?>
    <?= $this->Html->css('bootstrap.css') ?>
    <?= $this->Html->script('bootstrap.min.js')?>
    </head>
    <div class="container" style="margin-top: 20px">
        <div class="row">
            <div class="col-md-4">
                <h1 style="text-align: right">Andy</h1>
                <h3>Hi, My name is Andy I'm a CS major student from SFSU</h3>
            </div>            
            <div class="col-md-4">
                <img src="https://ichef.bbci.co.uk/images/ic/640x360/p049tgdb.jpg">
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>
    </body>
</html>


