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
        <title>About Teng</title>
    </head>
    <body class="home">
        <header class="row">
            <div class="header-title">
                <h1 style="text-align: center">About Me</h1>
        </header>
        <div class="row">
            <div class="columns large-12">
                <h3>Hello, my name is Teng I am a CS major at SFSU.</h3>
            </div>
        </div>
    </body>
</html>