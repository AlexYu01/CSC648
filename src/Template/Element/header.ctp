<header>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.0.3/socket.io.js"></script>
    <?= $this->Html->script('message-notification.js'); ?>
    <?= $this->Html->script('google_analytics.js'); ?>
    <script>
        var login =  '<?php
                       if ($this->request->session()->read('Auth')) {
                            echo $this->request->session()->read('Auth.User.user_id');
                        }else {
                            echo false;
                         }
                    ?>'
        getNotification(login)
    </script>
    <nav id="team5-menu" class="team5-menu" lang="en" style="position:fixed;right:0;left:0;z-index:1;">
        <div style="text-align: center; padding-top: 10px;">
            <a href="index.php" id="logo">PictureSque</a>
        </div>


        <div id="wm-user-component">
            
            <?php
            if ($this->request->session()->read('Auth')) {
                ?>
                <span class="signin" style="border: 0px;font-size:1.5em;float:left;font-family: 'Slabo 27px', serif;
                    font-weight: 200;"> Welcome,<?= $this->request->session()->read('Auth.User.username')?></span>
                <?php
                echo $this->Html->link('Logout', ['controller' => 'Users', 'action' => 'logout'], ['class' => 'signin', 'target' => '_self']);
                echo '<div class="signin" style="border:0px;"><span class="fa-layers fa-fw" style="font-size: 2em;">
                      <span class="far fa-envelope"></span>
                      <span id="message-counter" style="font-size:1.5em"></span>
                      </span></div>';
            } else {
                echo $this->Html->link('Sign Up', ['controller' => 'Users', 'action' => 'add'], ['class' => 'signin', 'target' => '_self']);
                echo $this->Html->link('Login', ['controller' => 'Users', 'action' => 'login'], ['class' => 'signin', 'target' => '_self']);
            }
            ?>
        </div>
    </nav>

</header>
