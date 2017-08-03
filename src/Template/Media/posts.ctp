<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= $this->Html->meta( 'favicon.ico' ) ?>
        <?php
        $this->layout = "default_no_menu";
        echo $this->Html->css( 'bootstrap.min' );
        echo $this->Html->script( 'jquery.min' );
        echo $this->Html->script( 'bootstrap.min' );
        ?>
    </head>
    <body>
        <div class="container">
            <h1>Your products</h1>
            <p><?= $this->Html->link( "Sell", ['action' => 'add'] ) ?></p>
            <table class="table table-hover">
                <tr>
                    <th>Id</th>
                    <th>Title</th>
                    <th>Created</th>
                    <th>Actions</th>
                </tr>

                <!-- Here's where we loop through our $articles query object, printing out article info -->

                <?php foreach ( $userProducts as $product ): ?>
                    <tr>
                        <td><?= $product->media_id ?>
                        </td>
                        <td>
                            <?=
                            /* $this->Html->link( $product->media_title, ['controller' => 'Media', 'action' => 'view',
                              '?' => ['id' => $product->media_id]] ) */
                            $this->Html->link( $product->media_title, ['action' => 'view',
                                $product->media_id] )
                            ?>
                        </td>
                        <td>
                            <?= $product->upload_date->format( DATE_RFC850 ) ?>
                        </td>
                        <td>
                            <?=
                            $this->Form->postLink(
                                    'Delete', ['action' => 'delete', $product->media_id], [
                                'confirm' => 'Are you sure?'] )
                            ?>
                            <?= $this->Html->link( 'Edit', ['action' => 'edit',$product->media_id] ) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </body>
</html>