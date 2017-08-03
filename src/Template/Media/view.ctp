<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php
        $this->layout = "default_no_menu";
        echo $this->Html->css( 'bootstrap.min' );
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
                        <?=
                        $this->Html->link( 'Edit', ['action' => 'edit', $userProduct->media_id], [
                            'type' => 'button', 'class' => 'btn btn-primary'] )
                        ?>
                        <?=
                        $this->Form->postLink(
                                'Delete', ['action' => 'delete', $userProduct->media_id], [
                            'confirm' => 'Are you sure?', 'type' => 'button',
                            'class' => 'btn btn-warning'] )
                        ?>
                    </div>
                </div>
            </div>

            <script>
            </script>
    </body>
</html>