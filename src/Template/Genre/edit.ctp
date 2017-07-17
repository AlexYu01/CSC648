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
                ['action' => 'delete', $genre->genre_id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $genre->genre_id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Genre'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="genre form large-9 medium-8 columns content">
    <?= $this->Form->create($genre) ?>
    <fieldset>
        <legend><?= __('Edit Genre') ?></legend>
        <?php
            echo $this->Form->control('genre_name');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
