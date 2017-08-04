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
            <h1>Your products</h1>
            <p> <?= $this->Html->link( $this->Html->tag('span', '', ['class' => 'glyphicon glyphicon-piggy-bank']) . 
                    ' Sell', ['action' => 'add'], 
                    ['type' => 'button', 'class' => 'btn btn-success btn-lg', 'escape' => false] ) ?>
                
                <?= $this->Html->link( $this->Html->tag('span', '', ['class' => 'glyphicon glyphicon-shopping-cart']) . 
                        ' Buy', ['controller' => 'Results', 'action' => 'search'], 
                        ['type' => 'button', 'class' => 'btn btn-primary btn-lg', 'escape' => false] ) ?>
            </p>
            <table class="table table-hover">
                <tr>
                    <th><?= $this->Paginator->sort('media_id', 
                            $this->Html->tag('span', '', ['class' => 'glyphicon glyphicon-sort']) . ' ID', ['escape' => false]) ?></th>
                    
                    <th><?= $this->Paginator->sort('media_title',
                            $this->Html->tag('span', '', ['class' => 'glyphicon glyphicon-sort']) . ' Title', ['escape' => false]) ?></th>
                    
                    <th><?= $this->Paginator->sort('upload_date', 
                            $this->Html->tag('span', '', ['class' => 'glyphicon glyphicon-sort']) . ' Created', ['escape' => false]) ?></th>
                    
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
                                $product->media_id], ['target' => '_blank'] )
                            ?>
                        </td>
                        <td>
                            <?= $product->upload_date->format( DATE_RFC850 ) ?>
                        </td>
                        <td>
                            <?= $this->Html->link( $this->Html->tag('span', '', ['class' => 'glyphicon glyphicon-wrench']) . 
                                    ' Edit', ['action' => 'edit',$product->media_id], 
                                    ['type' => 'button', 'class' => 'btn btn-info', 'target' => '_blank', 'escape' => false] ) ?>
                            
                            <?=
                            $this->Form->postLink($this->Html->tag('span', '', ['class' => 'glyphicon glyphicon-alert']) . 
                                    ' Delete', ['action' => 'delete', $product->media_id], 
                                    ['type' => 'button', 'class' => 'btn btn-danger', 'escape' => false, 'confirm' => 'Are you sure?'] )
                            ?>
                            
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </body>
</html>