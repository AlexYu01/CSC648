<?php
/**
  * @var \App\View\AppView $this
  */
?>
<head>
    
    <?php echo $this->Html->css('cake.css');
            echo $this->layout = 'default_no_menu'?>
</head>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Messages'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Messages'), ['controller' => 'Messages', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Message'), ['controller' => 'Messages', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Media'), ['controller' => 'Media', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Media'), ['controller' => 'Media', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="messages form large-9 medium-8 columns content">
    <?= $this->Form->create($message) ?>
    <fieldset>
        <legend><?= __('Add Message') ?></legend>
        <div class="input text required"><label for="sender_id">Sender</label><input type="text" name="sender_id" required="required" id="sender_id"></input></div>
        <div class="input text required"><label for="receiver-id">Receiver</label><input type="text" name="receiver_id" required="required" id="receiver-id"></input></div>
        <div class="input text required"><label for="media_id">media_id</label><input type="text" name="media_id" required="required" id="media_id"></input></div>
        <?php
            echo $this->Form->control('message_content');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
