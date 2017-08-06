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
            <!-- load buttons from user_menu -->
            <?= $this->element( 'user_menu' ); ?>
            
            <h1>My products</h1>
            <table class="table table-hover">
                <tr>
                    <th><?=
                        $this->Paginator->sort( 'media_id', $this->Html->tag( 'span', '', [
                                    'class' => 'glyphicon glyphicon-sort'] ) . ' ID', [
                            'escape' => false] )
                        ?></th>

                    <th><?=
                        $this->Paginator->sort( 'media_title', $this->Html->tag( 'span', '', [
                                    'class' => 'glyphicon glyphicon-sort'] ) . ' Title', [
                            'escape' => false] )
                        ?></th>

                    <th><?=
                        $this->Paginator->sort( 'upload_date', $this->Html->tag( 'span', '', [
                                    'class' => 'glyphicon glyphicon-sort'] ) . ' Created', [
                            'escape' => false] )
                        ?></th>

                    <th>Actions</th>
                </tr>

                <!-- Here's where we loop through our $articles query object, printing out article info -->

                <?php foreach ( $userProducts as $product ): ?>
                    <tr>
                        <td><?= $product->media_id ?>
                        </td>
                        <td>
                            <?=
                            $this->Html->link( $product->media_title, ['action' => 'view',
                                $product->media_id], ['target' => '_blank'] )
                            ?>
                        </td>
                        <td>
                            <?= $product->upload_date->format( DATE_RFC850 ) ?>
                        </td>
                        <td>
                            <?=
                            $this->Html->link( $this->Html->tag( 'span', '', ['class' => 'glyphicon glyphicon-wrench'] ) .
                                    ' Edit', ['action' => 'edit', $product->media_id], [
                                'type' => 'button',
                                'class' => 'btn btn-info', 'target' => '_blank',
                                'escape' => false] )
                            ?>

                            <?=
                            $this->Form->postLink( $this->Html->tag( 'span', '', [
                                        'class' => 'glyphicon glyphicon-alert'] ) .
                                    ' Delete', ['action' => 'delete', $product->media_id], [
                                'type' => 'button',
                                'class' => 'btn btn-danger', 'escape' => false, 'confirm' => 'Are you sure?'] )
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