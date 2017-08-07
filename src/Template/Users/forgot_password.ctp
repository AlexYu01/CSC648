<?php $this->layout = 'default_no_menu';
echo $this->Html->css('bootstrap.css');
echo $this->Html->css('login.css');
?>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    
    <body>
        <h2 class ="text-center">Forgot Password?</h2>
        <?= $this->Flash->render(); ?>
        <?= $this->Form->create(); ?>
        <legend><?= __('Please enter your email') ?></legend>
        <div class="text-center">
            <?php echo $this->Form->Control('email', array('name' => 'email', 
                'class' => 'form-control', 'placeholder' => 'E-mail Address')); ?>
            
            <?= $this->Form->submit('Submit', array('class' => 'button', 'id' => 'submit', 'onClick' => 'sendMessage()')); ?>
        </div>
        
        <script>
            function sendMessage(){
                alert("Further instructions has been sent to your e-mail. Thank you!")
            }
        </script>
    </body>
</html>
