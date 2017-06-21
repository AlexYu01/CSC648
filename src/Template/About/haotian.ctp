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
        
        <style>
            p.double {border-style: double; font-size: 18px; background-color: beige;}
            p.solid {border-style: solid; font-size: 36px; background-color: coral}
        </style>
    
    </head>
    <header>
        <title>Haotian Zhang's HomePage</title>  
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?= $this->Html->css('base.css') ?>
    </header>
    <body>
        <p class="solid">GROUP 5</p>
        <p class="double">I am Haotian Zhang! SF State senior student, major in Computer Science</p>
       
        <div>
            <?= $this->Html->image("Haotian&GoldenGateBridge",array('width'=> '400px', 'height'=>'250px')) ?>
        </div>
        <div class="header-title" style="margin-left: 0px;margin-top: 50px;">
                <?= $this->Html->link('Go Back To Home Page','/about/index',['class' => 'button'])?>
             </div> 
    </body>
    
</html>



 