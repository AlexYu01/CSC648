<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\Message[]|\Cake\Collection\CollectionInterface $messages
  */
?>
<head>
    <?php echo $this->Html->css('cake.css');
            echo $this->layout = 'default_no_menu'?>
</head>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Message'), ['action' => 'newMsg']) ?></li>
        <li><?= $this->Html->link(__('List Media'), ['controller' => 'Media', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Media'), ['controller' => 'Media', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="messages index large-9 medium-8 columns content">
    <h3><?= __('Messages') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('message_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('sender_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('receiver_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('media_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('message_content') ?></th>
                <th scope="col"><?= $this->Paginator->sort('date') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($messages as $message): ?>
            <tr <?php if($message->status == 0){echo 'style="font-weight: bold"';}?>>
                <td><?= $message->has('message_id') ? $this->Html->link($message->message_id, ['controller' => 'Messages', 'action' => 'view', $message->message_id]) : '' ?></td>
                <td><?= $this->Number->format($message->sender_id) ?></td>
                <td><?= $this->Number->format($message->receiver_id) ?></td>
                <td><?= $message->has('media_id') ? $this->Html->link($message->media_id, ['controller' => 'Media', 'action' => 'view', $message->media_id]) : '' ?></td>
                <td><?= h($message->message_content) ?></td>
                <td><?= h($message->date) ?></td>
                <td class="actions">
                    <?= $this->Form->postLink(__('Read'),['action' => 'read',$message->message_id],['id'=>''])?>
                    <?= $this->Form->postLink(__('add1'),['action' => 'newMsg'],['data'=>['sender_id'=> 2, 'receiver_id'=>34, 'media_id'=>2,'message_content'=>'tshi si test 1']])?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $message->message_id], ['confirm' => __('Are you sure you want to delete # {0}?', $message->message_id)]) ?>
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
