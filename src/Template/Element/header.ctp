<header>
        <nav id="team5-menu" class="team5-menu" lang="en" style="position:fixed;right:0;left:0;z-index:1;">
                <div class="div-logo" style="padding-top: 10px;">
                        <a href="index.php" id="logo">PictureSque</a>
                </div>

                <div id="wm-user-component">
                    <?php if($this->request->session()->read('Auth')) {
							echo '<a target="_self" href="logout" class="signin">logout</a>';
 						  } else {
                        	echo '<a target="_self" href="login" class="signin">Log In</a>';
							echo '<a target="_self" href="registration" class="signin">Sign Up</a>';
 						  } 
 					?>
                </div>
        </nav>
</header>
