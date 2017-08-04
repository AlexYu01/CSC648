<?php $this->layout = 'default_no_menu';
echo $this->Html->css('bootstrap.css');
echo $this->Html->css('login.css');
?>
<html>
<body>
    <script>
        var url = '<?= $this->Url->build(['controller'=>'Users','action'=>'facebook'],['fullBase' => true])?>';
        var response_url = "<?= $this->Url->build(['controller'=>'Media','action'=>'posts']);?>";
    </script>
<?=$this->Html->script('fb-login')?>
<div style="width: 800px; margin: 0 auto; position: relative;">
    <div class="panel row">
        <h2 class ="text-center">Login</h2>
        <?= $this->Flash->render(); ?>
        <?= $this->Form->create(); ?>
        <legend><?= __('Please enter your username and password') ?></legend>
        <div class="text-center">
            <?php echo $this->Form->Control('email', array('name' => 'email', 
                'class' => 'form-control', 'placeholder' => 'Email')); ?>
            <br><br>
            <?php echo $this->Form->Control('password', array('name' => 'password',
                'class' => 'form-control', 'placeholder' => 'Password')); ?>
            <br><br><br><br>
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
    </div>    
</div>
</body>
</html>