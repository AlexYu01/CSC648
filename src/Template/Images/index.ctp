<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\Image[]|\Cake\Collection\CollectionInterface $images
  */
?>
<nav class="large-2 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Tables') ?></li>
        <li><?= $this->Html->link(__('Users'), ['controller'=>'Users','action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('Genre'), ['controller'=>'Genre','action' => 'index']) ?> </li>
    </ul>
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Image'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="images index large-10 medium-8 columns content">
    <h3><?= __('Images') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('media_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('media_title') ?></th>
                <th scope="col"><?= $this->Paginator->sort('genre_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('author_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('price') ?></th>
                <th scope="col"><?= $this->Paginator->sort('upload_date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('permission') ?></th>
                <th scope="col"><?= $this->Paginator->sort('URL') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($images as $image): ?>
            <tr>
                <td><?= $this->Number->format($image->media_id) ?></td>
                <td><?= h($image->media_title) ?></td>
                <td><?= $this->Number->format($image->genre_id) ?></td>
                <td><?= $this->Number->format($image->author_id) ?></td>
                <td><?= $this->Number->format($image->price) ?></td>
                <td><?= date('Y-m-d G:i:s',strtotime($image->upload_date)) ?></td>
                <td><?= $this->Number->format($image->permission) ?></td>
                <td><?= h($image->URL) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $image->media_id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $image->media_id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $image->media_id], ['confirm' => __('Are you sure you want to delete # {0}?', $image->media_id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
