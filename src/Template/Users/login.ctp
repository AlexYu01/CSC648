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
        <?php echo $this->Form->Control('username', array('class' => 'form-control')); ?>
        <br><br>
        <?php echo $this->Form->Control('password', array('class' => 'form-control')); ?>
        <br><br><br><br>
        <div style="position: relative; bottom: 20px; left: 690px;">
            <?= $this->Form->submit('Login', array('class' => 'button')); ?>
            <?= $this->Form->end(); ?>
        </div>
    </div>
</div>
</div>
</body>
</html>