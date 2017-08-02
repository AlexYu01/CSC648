<?php $this->layout = "default_no_menu"; ?>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= $this->Html->meta( 'favicon' ) ?>
        <?= $this->Flash->render(); ?>
        <?= $this->Html->script( 'https://s.codepen.io/assets/libs/modernizr.js' ) ?>

        <?= $this->Html->css( 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css' ) ?>
        <?= $this->Html->css( 'bootstrap-theme.min' ) ?>

        <?= $this->Html->script( 'https://cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.0/css/bootstrapValidator.min.css' ) ?>

        <?= $this->Html->script( 'jquery.min' ) ?>
        <?= $this->Html->script( 'bootstrap.min' ) ?>
        <?= $this->Html->script( 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-validator/0.4.5/js/bootstrapvalidator.min.js' ) ?>

        <?= $this->Html->script( 'https://www.google.com/recaptcha/api.js' ) ?>

    </head>
    <style>
        #success_message{ 
            display: none;
        }

    </style>

    <body
        <div class="container">

            <?= $this->Form->create( $user, ['id' => 'register_form',
                'class' => 'form-horizontal'] )
            ?>
            <fieldset>

                <!-- Form Name -->
                <legend>Registration Form</legend>

                <!-- Email input-->
                <div class="form-group">
                    <label class="col-md-4 control-label">E-Mail</label>  
                    <div class="col-md-4 inputGroupContainer">
                            <?= $error = $this->Form->isFieldError( 'email' ) ? $this->Form->error( 'email' ) : ''; ?>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                            <?= $this->Form->control( 'email', ['class' => 'form-control',
                                'placeholder' => 'E-Mail Address', 'label' => false,
                                'error' => false] )
                            ?>
                        </div>
                    </div>
                </div>

                <!-- Text input-->

                <div class="form-group">
                    <label class="col-md-4 control-label">Username</label>  
                    <div class="col-md-4 inputGroupContainer">
                            <?= $error = $this->Form->isFieldError( 'username' ) ? $this->Form->error( 'username' ) : ''; ?>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                            <?= $this->Form->control( 'username', ['class' => 'form-control',
                                'placeholder' => 'Username', 'label' => false, 'error' => false] )
                            ?>
                        </div>
                    </div>
                </div>

                <!-- Password input-->

                <div class="form-group">
                    <label class="col-md-4 control-label" >Password</label> 
                    <div class="col-md-4 inputGroupContainer">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                            <?= $this->Form->control( 'password', ['class' => 'form-control', 'placeholder' => 'Password', 'label' => false] )?>
                        </div>
                    </div>
                </div>

                <!-- Password Confirm input-->

                <div class="form-group">
                    <label class="col-md-4 control-label" >Confirm Password</label> 
                    <div class="col-md-4 inputGroupContainer">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                            <?= $this->Form->control( 'confirmPassword', ['class' => 'form-control', 'placeholder' => 'Retype password','label' => false, 'type' => 'password'] )?>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label" ></label> 
                    <div class="col-md-4 inputGroupContainer">
                        <span class="error">Captcha is required</span>
                        <div id="cacaptchaContainer" class="g-recaptcha" data-callback="recaptchaCallback" data-sitekey="6LcidCsUAAAAADsatdH2I5HXTwwWOhXGYSq1EYwG"></div>
                    </div>
                </div>

                <!-- Success message -->
                <!--<div class="alert alert-success" role="alert" id="success_message">Success <i class="glyphicon glyphicon-thumbs-up"></i> Thanks for contacting us, we will get back to you shortly.</div> -->

                <!-- Button -->
                <div class="form-group">
                    <label class="col-md-4 control-label"></label>
                    <div class="col-md-4">
                        <button id="submit" type="submit" class="btn btn-primary" disabled>Create Account <span class="glyphicon glyphicon-chevron-right"></span></button>
                    </div>
                </div>

            </fieldset>
<?= $this->Form->end(); ?>
        </div>
    </div><!-- /.container -->


    <script>
        $(document).ready(function () {
            $('#register_form').bootstrapValidator({

                feedbackIcons: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },

                
                fields: {
                    username: {
                        validators: {
                            notEmpty: {
                                message: 'Please enter your desired username'
                            }
                        }
                    },
                    password: {
                        validators: {
                            stringLength: {
                                min: 8,
                                max: 20,
                                message: 'Password must be 8-20 characters'
                            },
                            notEmpty: {
                                message: 'Please enter your desired password'
                            },
                            regexp: {
                                regexp: /[A-Z]/,
                                message: 'Passwords must contain at least one capital letter'
                            }
                        }
                    },
                    confirmPassword: {
                        validators: {
                            notEmpty: {
                                message: 'Please retype your password'
                            },
                            identical: {
                                field: 'password',
                                message: 'Password does not match'
                            }
                        }
                    },
                    email: {
                        validators: {
                            notEmpty: {
                                message: 'Please supply your email address'
                            },
                            emailAddress: {
                                message: 'Please supply a valid email address'
                            }
                        }
                    }            
                }
            })
                    .on('success.form.bv', function (e) {
                        $('#success_message').slideDown({opacity: "show"}, "slow") // Do something ...
                        $('#register_form').data('bootstrapValidator').resetForm();
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
    function recaptchaCallback() {
        $('#submit').removeAttr('disabled');
       };
    </script>
</body>
</html>