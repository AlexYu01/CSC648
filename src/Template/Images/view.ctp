<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\Image $image
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Image'), ['action' => 'edit', $image->media_id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Image'), ['action' => 'delete', $image->media_id], ['confirm' => __('Are you sure you want to delete # {0}?', $image->media_id)]) ?> </li>
        <li><?= $this->Html->link(__('List Images'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Image'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="images view large-9 medium-8 columns content">
    <h3><?= h($image->media_id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Media Title') ?></th>
            <td><?= h($image->media_title) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('URL') ?></th>
            <td><?= h($image->URL) ?></td>
        </tr>
            <th scope="row"><?= __('GenreID') ?></th>
            <td><?= $this->Number->format($image->genre_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('AuthorID') ?></th>
            <td><?= $this->Number->format($image->author_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Price') ?></th>
            <td><?= $this->Number->format($image->price) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('UploadDate') ?></th>
            <td><?= date('Y-m-d G:i:s',strtotime($image->upload_date)) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Permission') ?></th>
            <td><?= $this->Number->format($image->permission) ?></td>
        </tr>
    </table>
</div>
