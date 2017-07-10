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
        <link rel="stylesheet" href="css/registrationForm.css"/>
        <script type="text/javascript"></script>
    </head>
    <body>
        <div style="width:400px; margin-right:auto; margin-left:auto">
            <form class="registration">
                First name: <input type="text" id="firstname"> <br>
                <br>
                Last name: <input type="text" id="lastname"> <br>
                <br>
                E-mail: <input type="text" id="email">
                <p>________________________________________________</p>

            
                Username: <input type="text" name="username"> <br>
                <br>
                Password: <input type="password" name="password"> <br>
           
        </form>
        </div>
        <div style="width:200px; margin-right:500px; margin-left:auto; font-size: large">
            <?= $this->Html->link('Back','/about/index',['class' => 'button'])?>
            <?= $this->Html->link('Submit','/about/index',['class' => 'Button'])?>
        </div>
    </body>
</html>
