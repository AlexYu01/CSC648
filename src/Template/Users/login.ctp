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

        <div id="text">
            <legend><?= __('Please enter your username and password') ?></legend>
            <?php echo $this->Form->Control('username', array('name' => 'email','class' => 'form-control', 'placeholder' => 'Username')); ?>
            <br><br>
            <?php echo $this->Form->Control('password', array('name' => 'password' ,'class' => 'form-control', 'placeholder' => 'Password')); ?>
            <br><br><br><br>
        </div>
        <div style="bottom:20px; margin-left: 150px;">
            <?= $this->Form->submit('Login', array('class' => 'button', 'id' => 'login')); ?>
            <?= $this->Form->end(); ?>
        </div>
    </div>
</div>
</body>
</html>