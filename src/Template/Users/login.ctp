<?php $this->layout = 'default_no_menu';?>

<div style="width: 800px; margin: 0 auto;">
    <div class="panel">
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
