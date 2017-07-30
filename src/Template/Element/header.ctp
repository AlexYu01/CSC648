<header>
        <nav id="team5-menu" class="team5-menu" lang="en" style="position:fixed;right:0;left:0;z-index:1;">
                <div style="text-align: center; padding-top: 10px;">
                        <a href="index.php" id="logo">PictureSque</a>
                </div>

                <div id="wm-user-component">
                    <?php if($this->request->session()->read('Auth')) {
                       // echo 'Hi'.$this->Auth->user('username');
echo $this->Html->link('Logout',['controller' => 'Users','action' => 'logout'],['class' => 'signin', 'target' => '_self']);
 } else {               
                        echo $this->Html->link('Sign UP',['controller' => 'Users','action' => 'add'],['class' => 'signin', 'target' => '_self']);
                        echo $this->Html->link('Login',['controller' => 'Users','action' => 'login'],['class' => 'signin', 'target' => '_self']);
                        //echo '<a target="_self" href="http://sfsuse.com/~tyu1/registration" class="signin">Sign Up</a>';
                        //echo '<a target="_self" href="http://sfsuse.com/~tyu1/login" class="signin">Login</a>';
 } ?>
                </div>
        </nav>
</header>
