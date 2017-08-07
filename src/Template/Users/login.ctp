<?php $this->layout = 'default_no_menu';
echo $this->Html->css('bootstrap.css');
?>
<html>
<body>
<div class="container">
<div style="width: 800px; margin: 0 auto; position: relative;">
    <div class="panel row">
        <h2 class ="text-center">Login</h2>
        <?= $this->Flash->render(); ?>
        <?= $this->Form->create(); ?>
        <legend><?= __('Please enter your username and password') ?></legend>
            <?= $this->Form->input('username'); ?>
            <?= $this->Form->input('password', array('type'=> 'password')); ?>
            <?= $this->Form->submit('Login', array('class' => 'button')); ?>
            <?= $this->Form->end(); ?>
    </div>
</div>
</div>
</body>
</html>