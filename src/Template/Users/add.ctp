<?php
$this->layout = "default_no_menu";
echo $this->Html->css( 'login.css' );

use Cake\Core\Configure;
?>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= $this->Html->script( 'modernizr-2.6.2.min' ) ?>

        <?= $this->Html->css( 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css' ) ?>
        <?= $this->Html->css( 'bootstrap-theme.min' ) ?>

        <?= $this->Html->css( 'https://cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.0/css/bootstrapValidator.min.css' ) ?>

        <?= $this->Html->script( 'jquery.min' ) ?>
        <?= $this->Html->script( 'bootstrap.min' ) ?>
        <?= $this->Html->script( 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-validator/0.4.5/js/bootstrapvalidator.min.js' ) ?>

        <?= $this->Html->script( 'https://www.google.com/recaptcha/api.js' ) ?>

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

            <?=
            $this->Form->create( $user, ['id' => 'register_form',
                'class' => 'form-horizontal'] )
            ?>

            <fieldset>
                <div style="width: 800px; margin: 0 auto; position: relative;">
                    <div class="panel row">
                        <h2 class="text-center">Registration</h2>
                        <legend></legend>

                <!-- Email input-->
                <div class="form-group">
                    <label class="col-md-4 control-label">E-Mail</label>
                    <div class="col-md-4 inputGroupContainer">
                        <?= $error = $this->Form->isFieldError( 'email' ) ? $this->Form->error( 'email' ) : ''; ?>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                            <?=
                            $this->Form->control( 'email', [
                                'class' => 'form-control', 'placeholder' => 'E-Mail Address',
                                'label' => false, 'error' => false] )
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
                            <?=
                            $this->Form->control( 'username', ['class' => 'form-control',
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
                            <?=
                            $this->Form->control( 'password', ['class' => 'form-control',
                                'placeholder' => 'Password', 'label' => false] )
                            ?>
                        </div>
                    </div>
                </div>

                <!-- Password Confirm input-->

                <div class="form-group">
                    <label class="col-md-4 control-label" >Confirm Password</label>
                    <div class="col-md-4 inputGroupContainer">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                            <?=
                            $this->Form->control( 'confirmPassword', [
                                'class' => 'form-control', 'placeholder' => 'Retype password',
                                'label' => false,
                                'type' => 'password'] )
                            ?>
                        </div>
                    </div>
                </div>
                
                <!-- Agreement checkbox-->

                <div class="form-group">
                    <label class="col-md-4 control-label" ></label>
                    <div class="col-md-4 inputGroupContainer">
                        <div class="form-check">
                            <label class="form-check-label">
                                <input name="agreement" type="checkbox" class="form-check-input">
                                I agree to <a href="#">TERMS OF USE</a> and <a href="#">PRIVACY POLICY</a>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Capctha -->
                <div class="form-group">
                    <label class="col-md-4 control-label" ></label>
                    <div class="col-md-4 inputGroupContainer">
                        <?= $this->Flash->render( 'captchaEmpty' ); ?>
                        <div class="g-recaptcha" data-sitekey="<?php echo Configure::read( 'google_recatpcha_settings.site_key' ); ?>"></div>
                    </div>
                </div>

                <!-- Success message -->
                <!--<div class="alert alert-success" role="alert" id="success_message">Success <i class="glyphicon glyphicon-thumbs-up"></i> Thanks for contacting us, we will get back to you shortly.</div> -->

                <!-- Button -->
                <div class="form-group">
                    <label class="col-md-4 control-label"></label>
                    <div class="col-md-4">
                        <button id="submitBtn" type="submit" class="btn btn-primary">Create Account <span class="glyphicon glyphicon-chevron-right"></span></button>
                    </div>
                </div>
            </fieldset>
            <?= $this->Form->end(); ?>
        </div>
        <!-- /.container -->


        <script>
            $(document).ready(function () {
                $('#register_form').bootstrapValidator({
                    feedbackIcons: {
                        valid: 'glyphicon glyphicon-ok',
                        invalid: 'glyphicon glyphicon-remove',
                        validating: 'glyphicon glyphicon-refresh'
                    },

                    fields: {
                        email: {
                            validators: {
                                notEmpty: {
                                    message: 'Please supply your email address'
                                },
                                emailAddress: {
                                    message: 'Please supply a valid email address'
                                }
                            }
                        },
                        username: {
                            validators: {
                                notEmpty: {
                                    message: 'Please enter your desired username'
                                },
                                regexp: {
                                    regexp: /^[A-Za-z0-9]+$/,
                                    message: 'Please enter only alphabets, or numbers'
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
                        agreement: {
                            validators: {
                                notEmpty: {
                                    message: 'Required'
                                }
                            }
                        }
                    }
                })
                        .on('success.form.bv', function (e) {
                            $('#success_message').slideDown({opacity: "show"}, "slow"); // Do something ...
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
        </script>
    </body>
</html>