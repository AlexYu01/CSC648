<?php $this->layout = 'default_no_menu';
echo $this->Html->css('bootstrap.css');
echo $this->Html->css('login.css');
?>
<html>
    <body>
        <div style="width: 800px; margin: 0 auto; position: relative;">
            <div class="panel row">
                <h2 class ="text-center">Login</h2>
                <?= $this->Flash->render(); ?>
                <?= $this->Form->create(); ?>
                <legend><?= __('Please enter your username and password') ?></legend>
                <div class="text-center">
                    <?php echo $this->Form->Control('username', array('name' => 'username', 
                        'class' => 'form-control', 'placeholder' => 'Username')); ?>
                    <br><br>
                    <?php echo $this->Form->Control('password', array('name' => 'username',
                        'class' => 'form-control', 'placeholder' => 'Password')); ?>
                    <?php echo $this->Html->link('Forgot Password?', ['controller' => 'Users', 'action' => 'forgot_password'], 
                            ['class' => 'forgotPassword', 'target' => '_blank']); ?>
                    
                    <br><br><br><br>
                </div>
                <div class="text-center">
                    <?= $this->Form->submit('Login', array('class' => 'button', 'id' => 'login')); ?>
                        <?= $this->Form->end(); ?>
                </div>
            </div>
        </div>
    </body>
</html>