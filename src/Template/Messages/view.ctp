<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\Message $message
  */
?>
<div class="messages view large-9 medium-8 columns content">
    <h3><?= h($message->message_id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Message') ?></th>
            <td><?= $message->has('message') ? $this->Html->link($message->message->message_id, ['controller' => 'Messages', 'action' => 'view', $message->message->message_id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Media') ?></th>
            <td><?= $message->has('media') ? $this->Html->link($message->media->media_id, ['controller' => 'Media', 'action' => 'view', $message->media->media_id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Message Content') ?></th>
            <td><?= h($message->message_content) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Sender Id') ?></th>
            <td><?= $this->Number->format($message->sender_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Receiver Id') ?></th>
            <td><?= $this->Number->format($message->receiver_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Date') ?></th>
            <td><?= h($message->date) ?></td>
        </tr>
    </table>
</div>
