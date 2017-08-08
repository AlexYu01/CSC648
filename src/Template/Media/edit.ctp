<?php $this->layout = "default_no_menu"; ?>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= $this->Flash->render(); ?>

        <?= $this->Html->script( 'modernizr-2.6.2.min' ) ?>

        <?= $this->Html->css( 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css' ) ?>
        <?= $this->Html->css( 'bootstrap-theme.min' ) ?>

        <?= $this->Html->css( 'https://cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.0/css/bootstrapValidator.min.css' ) ?>

        <?= $this->Html->script( 'jquery.min' ) ?>
        <?= $this->Html->script( 'bootstrap.min' ) ?>
        <?= $this->Html->script( 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-validator/0.4.5/js/bootstrapvalidator.min.js' ) ?>

        <!-- Input validation -->
        <?= $this->Html->script( 'media_form_validation' ) ?>
    </head>
    <style>
        .form-control {
            position: static !important;
        }

        .error-message { 
            color: #FF0000;
        }

        .error.message {
            color: #FF0000;
        }
    </style>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
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
            </div>
            <div class="row">
                <div class="col-md-12">
                    <?=
                    $this->Form->create( $userMedia, [
                        'id' => 'media', 'class' => 'form-horizontal'] )
                    ?>
                    <fieldset>

                        <!-- Form Name -->


                        <h2 class="text-center">Edit</h2>

                        <!-- Text input-->

                        <div class="form-group">
                            <label class="col-md-4 control-label">Title</label>  
                            <div class="col-md-4 inputGroupContainer">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-picture"></i></span>
                                    <?=
                                    $this->Form->control( 'media_title', ['class' => 'form-control',
                                        'label' => false] )
                                    ?>
                                </div>
                                <small class="form-text text-muted">30 characters max</small>
                            </div>
                        </div>

                        <!-- Text input-->

                        <div class="form-group">
                            <label class="col-md-4 control-label">Description</label>  
                            <div class="col-md-4 inputGroupContainer">            
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
                                    <?=
                                    $this->Form->control( 'media_desc', ['class' => 'form-control',
                                        'rows' => '3', 'label' => false] )
                                    ?>
                                </div>
                            </div>
                        </div>

                        <!-- Drop down-->

                        <div class="form-group">
                            <label class="col-md-4 control-label" >Genre</label> 
                            <div class="col-md-4 inputGroupContainer">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
                                    <?=
                                    $this->Form->select( 'genre_id', $genreList, [
                                        'empty' => 'Choose One',
                                        'class' => 'form-control selectpicker', 'label' => false] )
                                    ?>
                                </div>
                            </div>
                        </div>

                        <!-- Text input-->

                        <div class="form-group">
                            <label class="col-md-4 control-label" >Price</label> 
                            <div class="col-md-4 inputGroupContainer">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-usd"></i></span>
                                    <?=
                                    $this->Form->control( 'price', ['class' => 'form-control',
                                        'type' => 'text', 'label' => false] )
                                    ?>
                                </div>
                            </div>
                        </div>

                        <!-- Success message -->
                        <!--<div class="alert alert-success" role="alert" id="success_message">Success <i class="glyphicon glyphicon-thumbs-up"></i>Text here</div> -->

                        <!-- Button -->
                        <div class="form-group">
                            <label class="col-md-4 control-label"></label>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary" >Save! <span class="glyphicon glyphicon-save"></span></button>
                            </div>
                        </div>
                    </fieldset>
                </div>
            </div>
            <?= $this->Form->end(); ?>
        </div>
        <!-- /.container -->


        <script>
            /* Input validation taken care of by media_form_validation.js */
        </script>
    </body>
</html>