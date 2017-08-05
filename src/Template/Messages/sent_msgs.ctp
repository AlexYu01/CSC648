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
            <?= $this->element('user_menu'); ?>
            <h1>My Outbox</h1>
            <table class="table table-hover">
                <tr>                 
                    <th><?=
                        $this->Paginator->sort( 'receiver_id', $this->Html->tag( 'span', '', [
                                    'class' => 'glyphicon glyphicon-sort'] ) . ' To:', [
                            'escape' => false] )
                        ?></th>

                    <th>Title</th>

                    <th><?=
                        $this->Paginator->sort( 'message_content', $this->Html->tag( 'span', '', [
                                    'class' => 'glyphicon glyphicon-sort'] ) . ' Message Content', [
                            'escape' => false] )
                        ?></th>

                    <th><?=
                        $this->Paginator->sort( 'date', $this->Html->tag( 'span', '', [
                                    'class' => 'glyphicon glyphicon-sort'] ) . ' Created', [
                            'escape' => false] )
                        ?></th>

                    <th>Actions</th>
                </tr>

                <!-- Here's where we loop through our $articles query object, printing out article info -->

                <?php foreach ( $messages as $message ): ?>
                    <tr>
                        <td><?= $message->u['username'] ?></td>
                        <td><?=
                            $message->has( 'media_id' ) ? $this->Html->link( $message->m['media_title'], [
                                        'controller' => 'Media', 'action' => 'view',
                                        $message->media_id] ) : ''
                            ?></td>
                        <td><?= h( $message->message_content ) ?></td>
                        <td><?= $message->date->format( DATE_RFC850 ) ?></td>
                        <td class="actions">
                            <?=
                            $this->Form->postLink( $this->Html->tag( 'span', '', [
                                        'class' => 'glyphicon glyphicon-trash'] ) .
                                    ' Delete', ['action' => 'delete', $message->message_id], [
                                'confirm' => __( 'Are you sure you want to delete?', $message->message_id ),
                                'type' => 'button', 'class' => 'btn btn-danger btn-sm',
                                'escape' => false] )
                            ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
        <div class="text-center">
            <ul class="pagination">
                <?= $this->Paginator->first( '<< ' . __( 'first' ) ) ?>
                <?= $this->Paginator->prev( '< ' . __( 'previous' ) ) ?>
                <?= $this->Paginator->numbers() ?>
                <?= $this->Paginator->next( __( 'next' ) . ' >' ) ?>
                <?= $this->Paginator->last( __( 'last' ) . ' >>' ) ?>
            </ul>
        </div>
    </body>
</html>