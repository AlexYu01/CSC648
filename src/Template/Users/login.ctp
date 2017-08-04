<?php $this->layout = 'default_no_menu';
echo $this->Html->css('bootstrap.css');
echo $this->Html->css('login.css');
?>
<html>
<body>    
<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '1411849535597521',
      cookie     : true,
      xfbml      : true,
      version    : 'v2.8'
    });
    FB.AppEvents.logPageView();   
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>
<div style="width: 800px; margin: 0 auto; position: relative;">
    <div class="panel row">
        <h2 class ="text-center">Login</h2>
        <?= $this->Flash->render(); ?>
        <?= $this->Form->create(); ?>
        <legend><?= __('Please enter your username and password') ?></legend>
        <div class="text-center">
            <?php echo $this->Form->Control('username', array('name' => 'username', 
                'class' => 'form-control', 'placeholder' => 'Username')); ?>
            <br><br>
            <?php echo $this->Form->Control('password', array('name' => 'username',
                'class' => 'form-control', 'placeholder' => 'Password')); ?>
            <br><br><br><br>
        </div>
        <div class="text-center">
        <?= $this->Form->submit('Login', array('class' => 'button', 'id' => 'login')); ?>
        <?= $this->Form->end(); ?>
        </div>
        
        
        <div scope="public_profile,email"
             onlogin="checkLoginState();" 
             class="fb-login-button" data-max-rows="1" data-size="large" data-button-type="continue_with" data-show-faces="false" data-auto-logout-link="false" data-use-continue-as="false"></div>
    </div>
    <script>
        
function checkLoginState() {
  FB.getLoginStatus(function(response) {
    //statusChangeCallback(response);
    var token,name,email,id;
    console.log(JSON.stringify(response));
    if(response.status == 'connected'){
        token = response.authResponse.accessToken;
        id = response.authResponse.userID;
        FB.api('/me',{fields:'name,email'},function(response){
            name = response.name.replace(/\s/g, '');
            email = response.email;
            console.log(name);
            console.log(token);
            console.log(email);
            console.log(id);
            $.ajax({
                                url:'<?= $this->Url->build(['controller'=>'Users','action'=>'facebook'],['fullBase' => true])?>',
                                type: 'POST',
                                data:
                                {
                                    _method: 'POST',
                                    name: name,
                                    email:email,
                                    token: token,
                                    user_id:id
                                },
                                        success:function(res){
                                            //$.notify('Success', {position: 'top left', style: 'bootstrap', className: 'success'});
                                            console.log(res);
                                        }
                            });
        })
    }
  });
}
    </script>
</div>
</body>
</html>