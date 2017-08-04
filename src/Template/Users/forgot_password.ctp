<?php $this->layout = 'default_no_menu';
echo $this->Html->css('bootstrap.css');
echo $this->Html->css('login.css');
?>
<html>
    <body>
        <div style="width: 800px; margin: 0 auto; position: relative;">
            <div class="panel row">
                <h2 class ="text-center">Forgot Password</h2>
                <?= $this->Flash->render(); ?>
                <?= $this->Form->create(); ?>
                <legend><?= __('Please enter your email and username') ?></legend>
                <div class="text-center">
                    <?php echo $this->Form->Control('email', array('name' => 'email', 
                        'class' => 'form-control', 'placeholder' => 'E-mail Address')); ?>
                    <br><br>
                    <?php echo $this->Form->Control('username', array('name' => 'username', 
                        'class' => 'form-control', 'placeholder' => 'Username')); ?>
                    <br><br><br><br>
                    <?= $this->Form->submit('Submit', array('class' => 'button', 'id' => 'submit')); ?>

                </div>
            </div>
        </div>
        <script>
            
        </script>
    </body>
</html>
