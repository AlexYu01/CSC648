<?php $this->layout = 'default_no_menu';
echo $this->Html->css('bootstrap.css');
echo $this->Html->css('login.css');
?>
<html>
<body>
    
    <!-- Uses Facebook API to allow users to login through Facebook.-->
    <script>
        var url = '<?= $this->Url->build(['controller'=>'Users','action'=>'facebook'],['fullBase' => true])?>';
        var response_url = "<?= $this->Url->build(['controller'=>'Media','action'=>'posts']);?>";
    </script>
<?=$this->Html->script('fb-login')?>
    
        <!-- Login form consisting of an email and password. -->
        <h2 class ="text-center">Login</h2>
        <?= $this->Flash->render(); ?>
        <?= $this->Form->create(); ?>
        <legend><?= __('Please enter your username and password') ?></legend>
        <div class="text-center">
            <?php echo $this->Form->Control('email', array('name' => 'email', 
                'class' => 'form-control', 'placeholder' => 'Email')); ?>
            <br><br>
            
            <!-- Forgot Password link. -->
            <?php echo $this->Form->Control('password', array('name' => 'password',
                'class' => 'form-control', 'placeholder' => 'Password')); ?>
            <?php echo $this->Html->link('Forgot Password?', ['controller' => 'Users', 'action' => 'forgot_password'], 
                            ['class' => 'forgotPassword', 'target' => '_blank']); ?> 
            
        </div>
        <div class="text-center">
        <?= $this->Form->submit('Login', array('class' => 'button', 'id' => 'login')); ?>
        <?= $this->Form->end(); ?>
        </div>
        
        <div class="text-center" id="fb-bt">
        <div scope="public_profile,email"
             onlogin="checkLoginState();" 
             class="fb-login-button" data-max-rows="1" data-size="large" data-button-type="continue_with" data-show-faces="false" data-auto-logout-link="false" data-use-continue-as="false"></div>
        </div>  
</body>

</html>