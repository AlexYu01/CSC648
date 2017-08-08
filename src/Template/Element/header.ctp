<header>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.0.3/socket.io.js"></script>
    <?= $this->Html->script('message-notification.js'); ?>
    <?= $this->Html->script('google_analytics.js'); ?>    
    <nav id="team5-menu" class="team5-menu" lang="en" style="position:fixed;right:0;left:0;z-index:1;">
        <div class="div-logo" style="padding-top: 10px;">
            <a href="<?= $this->url->build(['controller' => 'Homepage', 'action' => 'index'])?>" id="logo">PictureSque</a>
        </div>
        
      
      <div id="wm-user-component">
            
        <?php
            if ($this->request->session()->read('Auth')) {
                ?>
                <span style="margin:-50px 0px 0px 40px; border: 0px; font-size:1.5em; float:left;"> Welcome,<?= $this->request->session()->read('Auth.User.username')?></span>
                <?php
                echo $this->Html->link('Logout', ['controller' => 'Users', 'action' => 'logout'], ['class' => 'signin', 'target' => '_self']);
                echo '<a class="signin" style="border:0px;margin-top:-5px;" href='. $this->Url->build(['controller'=>'Messages','action'=>'received_msgs']) .'><span class="fa-layers fa-fw" style="font-size: 2em;">
                      <span class="far fa-envelope"></span>
                      <span id="message-counter" style="font-size:1.5em"></span>
                      </span></a>';
            } else {
                echo $this->Html->link('Sign Up', ['controller' => 'Users', 'action' => 'add'], ['class' => 'signin', 'target' => '_self']);
                echo $this->Html->link('Login', ['controller' => 'Users', 'action' => 'login'], ['class' => 'signin', 'target' => '_self']);
            }
            ?>
        </div>
    </nav>
    <script>
        var login =  '<?php
                       if ($this->request->session()->read('Auth')) {
                            echo $this->request->session()->read('Auth.User.user_id');
                        }else {
                            echo false;
                         }
                    ?>'
        var counter = <?php if(!empty($unreadCount)){ echo $unreadCount;}else{echo '0';}?>
        
        if(counter > 0){
            $('#message-counter').addClass('fa-layers-counter');
            $('.fa-layers-counter').html(counter);
        }
        getNotification(login,counter);
   
  </script>
</header>