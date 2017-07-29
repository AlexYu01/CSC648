<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $user->user_id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $user->user_id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Users'), ['action' => 'index']) ?></li>
<<<<<<< HEAD
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
=======
>>>>>>> 5b5709bd7be5c19747478b9c97bad4915736a305
    </ul>
</nav>
<div class="users form large-9 medium-8 columns content">
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('Edit User') ?></legend>
        <?php
            echo $this->Form->control('username');
            echo $this->Form->control('password');
            echo $this->Form->control('email');
<<<<<<< HEAD
            echo $this->Form->control('registered_date', ['empty' => true]);
            echo $this->Form->control('last_login_date', ['empty' => true]);
            echo $this->Form->control('token');
            echo $this->Form->control('salt');
            echo $this->Form->control('role');
=======
            echo $this->Form->control('registered_date',['value'=>date('Y-m-d G:i:s',$user->registered_date)]);
            echo $this->Form->control('last_login_date',['value'=>date('Y-m-d G:i:s',$user->registered_date)]);
            echo $this->Form->control('salt',['value'=>h($user->salt)]);
>>>>>>> 5b5709bd7be5c19747478b9c97bad4915736a305
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
