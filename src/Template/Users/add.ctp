<?php
/**
  * @var \App\View\AppView $this
  */
?>
<!--
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Users'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="users form large-9 medium-8 columns content">
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('Add User') ?></legend>
        <?php
            echo $this->Form->control('username');
            echo $this->Form->control('password');
            echo $this->Form->control('email');
            /*
            echo $this->Form->control('registered_date', ['empty' => true]);
            echo $this->Form->control('last_login_date', ['empty' => true]);
            echo $this->Form->control('token');
            echo $this->Form->control('salt');
            echo $this->Form->control('role');
             */
            
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
    
    <form action="test" method="post">
        <input type="text" name="useranme">
        <input type="text" name="password">
        <input type="submit">
    </form>
</div>
-->

<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Users'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="index large-4 medium-4 large-offset-4 medium-offset-4 columns">
            <h1 class="text-center">Registration Form </h1>
    <?= $this->Form->create($user) ?>
    <fieldset>
        <?php
           
            echo $this->Form->control('username');
            echo $this->Form->control('password');
            echo $this->Form->control('email');
            /*
            echo $this->Form->control('registered_date', ['empty' => true]);
            echo $this->Form->control('last_login_date', ['empty' => true]);
            echo $this->Form->control('token');
            echo $this->Form->control('salt');
            echo $this->Form->control('role');
             */
            
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
    
</div>