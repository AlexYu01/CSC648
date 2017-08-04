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

    </style>
    <body>
        <div class="container">

            <div class="row">
                <div class="col-md-8">
                    <?php
                    if ( $userProduct->type_id == 1 ) {
                        echo $this->Html->image( $userProduct->media_link, ['alt' => $userProduct->media_title,
                            'width' => '100%', 'height' => 'auto', 'class' => 'img-rounded center-block'] );
                    } else {
                        echo '<div class="embed-responsive embed-responsive-16by9">';
                        echo $this->Html->media( '/img/' . $userProduct->media_link, [
                            'controls', 'controlsList' => 'nodownload', 'class' => 'embed-responsive-item center-block'] );
                        echo '</div>';
                    }
                    ?>
                </div>

                <div class="col-md-4">
                    <dl class="dl-horizontal">

                        <dt>Title:</dt>
                        <dd><?= $userProduct->media_title ?></dd>

                        <dt>Description</dt>
                        <dd><?= $userProduct->media_desc ?></dd>

                        <dt>Price:</dt>
                        <dd>$<?= $userProduct->price ?></dd>

                        <dt>Sold Count:</dt>
                        <dd><?= $userProduct->sold_count ?></dd>

                        <dt>Upload Date:</dt>
                        <dd><?= $userProduct->upload_date->format( DATE_RFC850 ) ?></dd>
                    </dl>
                    <div class="btn-toolbar" role="group">
                        <?= $this->Html->link( $this->Html->tag('span', '', ['class' => 'glyphicon glyphicon-wrench']) . 
                                    ' Edit', ['action' => 'edit',$userProduct->media_id], 
                                    ['type' => 'button', 'class' => 'btn btn-info', 'escape' => false] ) ?>
                            
                            <?=
                            $this->Form->postLink($this->Html->tag('span', '', ['class' => 'glyphicon glyphicon-alert']) . 
                                    ' Delete', ['action' => 'delete', $userProduct->media_id], 
                                    ['type' => 'button', 'class' => 'btn btn-danger', 'escape' => false, 'confirm' => 'Are you sure?'] )
                            ?>
                    </div>
                </div>
            </div>

            <script>
            </script>
    </body>
</html>