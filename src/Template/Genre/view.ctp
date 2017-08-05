<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\Genre $genre
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Genre'), ['action' => 'edit', $genre->genre_id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Genre'), ['action' => 'delete', $genre->genre_id], ['confirm' => __('Are you sure you want to delete # {0}?', $genre->genre_id)]) ?> </li>
        <li><?= $this->Html->link(__('List Genre'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Genre'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="genre view large-9 medium-8 columns content">
    <h3><?= h($genre->ID) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('GenreName') ?></th>
            <td><?= h($genre->genre_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('GenreID') ?></th>
            <td><?= $this->Number->format($genre->genre_id) ?></td>
        </tr>
    </table>
</div>
