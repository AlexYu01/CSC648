<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php
        $this->layout = "default_no_menu";
        echo $this->Html->css( 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css' );
        echo $this->Html->script( 'jquery.min' );
        echo $this->Html->script( 'bootstrap.min' );
        ?>
    </head>
    <body>
        <div class="container">
            <h1>Sent Messages</h1>
            <p> <?= $this->Html->link( $this->Html->tag('span', '', ['class' => 'glyphicon glyphicon-piggy-bank']) . 
                    ' Sell', ['action' => 'add'], 
                    ['type' => 'button', 'class' => 'btn btn-success btn-lg', 'escape' => false] ) ?>
                
                <?= $this->Html->link( $this->Html->tag('span', '', ['class' => 'glyphicon glyphicon-shopping-cart']) . 
                        ' Buy', ['controller' => 'Results', 'action' => 'search'], 
                        ['type' => 'button', 'class' => 'btn btn-primary btn-lg', 'escape' => false] ) ?>
            </p>
            <table class="table table-hover">
                <tr>
                <th scope="col"><?= $this->Paginator->sort('message_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('sender_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('receiver_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('media_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('message_content') ?></th>
                <th scope="col"><?= $this->Paginator->sort('date') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>

                <!-- Here's where we loop through our $articles query object, printing out article info -->

                <?php foreach ( $messages as $message ): ?>
                    <tr <?php if($message->status == 0){echo 'style="font-weight: bold"';}?>>
                <td><?= $message->has('message_id') ? $this->Html->link($message->message_id, ['controller' => 'Messages', 'action' => 'view', $message->message_id]) : '' ?></td>
                <td><?= $this->Number->format($message->sender_id) ?></td>
                <td><?= $this->Number->format($message->receiver_id) ?></td>
                <td><?= $message->has('media_id') ? $this->Html->link($message->media_id, ['controller' => 'Media', 'action' => 'view', $message->media_id]) : '' ?></td>
                <td><?= h($message->message_content) ?></td>
                <td><?= h($message->date) ?></td>
                <td class="actions">
                    <?= $this->Form->postLink(__('Read'),['controller'=>'Messages','action' => 'read',$message->message_id],['id'=>''])?>
                    <?= $this->Form->postLink(__('add1'),['action' => 'newMsg'],['data'=>['sender_id'=> 2, 'receiver_id'=>34, 'media_id'=>2,'message_content'=>'tshi si test 1']])?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $message->message_id], ['confirm' => __('Are you sure you want to delete # {0}?', $message->message_id)]) ?>
                </td>
            </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </body>
</html>