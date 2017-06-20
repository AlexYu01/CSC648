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
        <title>Haotian Zhang's HomePage</title>  
    </head>
    <header>
        <?php echo 'I am Haotian Zhang! SF State senior student, major in Computer Science'; ?>
    </header>
    <body>
        <div>
            <?= $this->Html->image("Haotian&GoldenGateBridge",array('width'=> '400px', 'height'=>'250px')) ?>
        </div>
        <div class="header-title" style="margin-left: 15px;margin-left: 15px;">
                <?= $this->Html->link('Go Back To Home Page','/about/index',['class' => 'button'])?>
             </div> 
    </body>
    
</html>



 