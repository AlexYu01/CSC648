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
    <style>
        .btn-toolbar {
            padding: 30px
        }
        p.desc {
            word-break: break-all;
            width: auto;  
        }
    </style>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <?php
                    if ( $userMedia->type_id == 1 ) {
                        echo $this->Html->image( $userMedia->media_link, ['alt' => $userMedia->media_title,
                            'width' => '100%', 'height' => 'auto', 'class' => 'img-rounded center-block'] );
                    } else {
                        echo '<div class="embed-responsive embed-responsive-16by9">';
                        echo $this->Html->media( '/img/' . $userMedia->media_link, [
                            'controls', 'controlsList' => 'nodownload', 'class' => 'embed-responsive-item center-block'] );
                        echo '</div>';
                    }
                    ?>
                </div>

                <div class="col-md-4">
                    <dl class="dl-horizontal">

                        <dt>Title:</dt>
                        <dd><?= $userMedia->media_title ?></dd>

                        <dt>Description:</dt>
                        <dd><p class="desc"><?= $userMedia->media_desc ?></p></dd>

                        <dt>Price:</dt>
                        <dd>$<?= $userMedia->price ?></dd>

                        <dt>Sold Count:</dt>
                        <dd><?= $userMedia->sold_count ?></dd>

                        <dt>Upload Date:</dt>
                        <dd><?= $userMedia->upload_date->format( DATE_RFC850 ) ?></dd>
                    </dl>
                    <div class="btn-toolbar" role="group">
                        <?=
                        $this->Html->link( $this->Html->tag( 'span', '', ['class' => 'glyphicon glyphicon-wrench'] ) .
                                ' Edit', ['action' => 'edit', $userMedia->media_id], [
                            'type' => 'button', 'class' => 'btn btn-info', 'escape' => false] )
                        ?>

                        <?=
                        $this->Form->postLink( $this->Html->tag( 'span', '', ['class' => 'glyphicon glyphicon-alert'] ) .
                                ' Delete', ['action' => 'delete', $userMedia->media_id], [
                            'type' => 'button', 'class' => 'btn btn-danger', 'escape' => false,
                            'confirm' => 'Are you sure?'] )
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>