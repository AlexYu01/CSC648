<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Images'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="images form large-9 medium-8 columns content">
    <?= $this->Form->create($image) ?>
    <fieldset>
        <legend><?= __('Add Image') ?></legend>
        <?php
            echo $this->Form->control('ImageTitle');
            echo $this->Form->control('genreID');
            echo $this->Form->control('authorID');
            echo $this->Form->control('price');
            echo $this->Form->control('UploadDate',['value'=>date('Y-m-d G:i:s',time())]);
            echo $this->Form->control('permission');
            echo $this->Form->control('URL');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
