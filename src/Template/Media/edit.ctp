<?php $this->layout = "default_no_menu"; ?>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <?= $this->Html->script( 'https://s.codepen.io/assets/libs/modernizr.js' ) ?>

        <?= $this->Html->css( 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css' ) ?>
        <?= $this->Html->css( 'bootstrap-theme.min' ) ?>

        <?= $this->Html->script( 'https://cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.0/css/bootstrapValidator.min.css' ) ?>

        <?= $this->Html->script( 'jquery.min' ) ?>
        <?= $this->Html->script( 'bootstrap.min' ) ?>
        <?= $this->Html->script( 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-validator/0.4.5/js/bootstrapvalidator.min.js' ) ?>
    </head>
    <style>
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
                        'id' => 'media_form', 'class' => 'form-horizontal'] )
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

                        <!-- Text input-->

                        <div class="form-group">
                            <label class="col-md-4 control-label" >Genre</label> 
                            <div class="col-md-4 inputGroupContainer">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
                                    <?=
                                    $this->Form->select( 'genre_id', $genreList, [
                                        'class' => 'form-control selectpicker', 'label' => false] )
                                    ?>
                                </div>
                            </div>
                        </div>

                        <!-- Drop down-->

                        <div class="form-group">
                            <label class="col-md-4 control-label" >Price</label> 
                            <div class="col-md-4 inputGroupContainer">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-usd"></i></span>
                                    <?=
                                    $this->Form->control( 'price', ['class' => 'form-control',
                                        'type' => 'number', 'label' => false] )
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
            $(document).ready(function () {
                $('#media_form').bootstrapValidator({

                    feedbackIcons: {
                        valid: 'glyphicon glyphicon-ok',
                        invalid: 'glyphicon glyphicon-remove',
                        validating: 'glyphicon glyphicon-refresh'
                    },
                    fields: {
                        media_title: {
                            validators: {
                                notEmpty: {
                                    message: 'Please enter a title for your media'
                                },
                                stringLength: {
                                    max: 30,
                                    message: 'No more than 30 characters allowed'
                                }
                            }
                        },
                        media_desc: {
                            validators: {
                                notEmpty: {
                                    message: 'Please enter a description for your media'
                                },
                                stringLength: {
                                    min: 10,
                                    max: 200,
                                    message: 'Please enter at least 10 characters and no more than 200'
                                }
                            }
                        },
                        price: {
                            validators: {
                                notEmpty: {
                                    message: 'Please enter a price for your media'
                                },
                                greaterThan: {
                                    value: 0,
                                    message: 'Price must be greater than $0'
                                },
                                lessThan: {
                                    value: 1000000,
                                    message: 'Price must be less than $1 million'
                                }
                            }
                        }
                    }
                })
                        .on('success.form.bv', function (e) {
                            $('#success_message').slideDown({opacity: "show"}, "slow") // Do something ...
                            $('#media_form').data('bootstrapValidator').resetForm();
                            /*
                             // Prevent form submission
                             e.preventDefault();
                             
                             // Get the form instance
                             var $form = $(e.target);
                             
                             // Get the BootstrapValidator instance
                             var bv = $form.data('bootstrapValidator');
                             
                             // Use Ajax to submit form data
                             $.post($form.attr('action'), $form.serialize(), function (result) {
                             console.log(result);
                             }, 'json');*/
                        });
            });

        </script>
    </body>
</html>