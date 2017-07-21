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
        <link rel="stylesheet" href="css/registrationForm.css"/>
        <script type="text/javascript"></script>
    </head>
    <body>
        <?php 
            // Defines empty variables
            $first_name_err = $last_name_err = $email_err = $username_err = $password_err = "";
            $first_name = $last_name = $email = $username = $password = "";
            
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (empty($_POST["name"])) {
                    $first_name_err = "Name is required";
                } else {
                    $first_name = test_input($_POST["name"]);
                    // check if name only contains letters and whitespace
                 if (!preg_match("/^[a-zA-Z ]*$/",$first_name)) {
                     $first_name_err = "Only letters and white space allowed";
                    }
                }
            }
  
            
            function test_input($data)
            {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }
            // Check for valid inputs from the user and shows error message if needed
        ?>
        <div class="index large-4 medium-4 large-offset-4 medium-offset-4 columns">
            <h1 class="text-center">Registration Form </h1>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                First name: <input type="text" name="first_name" value="<?php echo $first_name; ?>">
                <?php echo $first_name_err; ?>
                <br><br>
                Last name: <input type="text" id="lastname" value="<?php echo $last_name; ?>"> <br>
                <br>
                E-mail: <input type="text" id="email" value="<?php echo $email; ?>">
                
                <p>____________________________________________________________________</p>
                
                Username: <input type="text" name="username" value="<?php echo $username; ?>">
                <div style="position: relative; font-size: small">
                    <?php echo "5-15 characters long, only letters and numbers."?>
                </div>
                <br>
                Password: <input type="password" name="password" value="<?php echo $password; ?>">
                <div style="position: relative; font-size: small">
                    <?php echo "8-20 characters long." ?>
                </div>
                <?= $this->Form->submit('Register', array('class' => 'button')); ?>
            </form>
        </div>
        <!--
        <div style="width:200px; margin-right:400px; margin-left:auto; font-size: large">
            <?= $this->Html->link('Back','/about/index',['class' => 'button'])?>
            <?= $this->Html->link('Submit','/about/index',['class' => 'button'])?>
        </div>
        -->
    </body>
</html>
