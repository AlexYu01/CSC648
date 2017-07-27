<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\Genre[]|\Cake\Collection\CollectionInterface $genre
  */
?>
<nav class="large-2 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Tables') ?></li>
        <li><?= $this->Html->link(__('Users'), ['controller'=>'Users','action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('Image'), ['controller'=>'Images','action' => 'index']) ?> </li>
    </ul>
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Genre'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="genre index large-10 medium-8 columns content">
    <h3><?= __('Genre') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('genre_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('genre_name') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($genre as $genre): ?>
            <tr>
                <td><?= $this->Number->format($genre->genre_id) ?></td>
                <td><?= h($genre->genre_name) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $genre->genre_id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $genre->genre_id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $genre->genre_id], ['confirm' => __('Are you sure you want to delete # {0}?', $genre->genre_id)]) ?>
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
