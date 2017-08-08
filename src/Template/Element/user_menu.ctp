<!-- buttons for user posts.ctp, received_msgs.ctp, and sent_msgs.ctp -->
<style>
    @media (max-width: 768px) {
        .btn {
            font-size:11px;
            padding:4px 6px;
        }
    }
</style>
<div class="container-fluid">
        <?=
        $this->Html->link( $this->Html->tag( 'span', '', ['class' => 'glyphicon glyphicon-piggy-bank'] ) .
                ' Sell', ['controller' => 'media', 'action' => 'add'], [
            'type' => 'button',
            'class' => 'btn btn-success btn-lg', 'escape' => false] )
        ?>

        <?=
        $this->Html->link( $this->Html->tag( 'span', '', ['class' => 'glyphicon glyphicon-shopping-cart'] ) .
                ' Buy', ['controller' => 'Results', 'action' => 'search'], [
            'type' => 'button', 'class' => 'btn btn-primary btn-lg',
            'escape' => false] )
        ?>

        <?=
        $this->Html->link( $this->Html->tag( 'span', '', ['class' => 'glyphicon glyphicon-picture'] ) .
                ' My Products', ['controller' => 'Media', 'action' => 'posts'], [
            'type' => 'button', 'class' => 'btn btn-info btn-lg', 'escape' => false] )
        ?>
        <div class="pull-right">
            <?=
            $this->Html->link( $this->Html->tag( 'span', '', ['class' => 'glyphicon glyphicon-envelope'] ) .
                    ' My inbox', ['controller' => 'Messages', 'action' => 'received_msgs'], [
                'type' => 'button', 'class' => 'btn btn-info btn-lg',
                'escape' => false] )
            ?>
            <?=
            $this->Html->link( $this->Html->tag( 'span', '', ['class' => 'glyphicon glyphicon-send'] ) .
                    ' My outbox', ['controller' => 'Messages', 'action' => 'sent_msgs'], [
                'type' => 'button', 'class' => 'btn btn-info btn-lg',
                'escape' => false] )
            ?>

    </div>
</div>
<?= $this->Flash->render() ?>