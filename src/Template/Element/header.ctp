<header>
    <nav id="team5-menu" class="team5-menu" lang="en" style="position:fixed;right:0;left:0;z-index:1;">
        <div class="div-logo" style="padding-top: 10px;">
            <a href="<?= $this->url->build(['controller' => 'Homepage', 'action' => 'index'])?>" id="logo">PictureSque</a>
        </div>
        <?= $this->Html->meta( 'favicon.ico' ) ?>
        <div id="wm-user-component">
            <?php
            if ( $this->request->session()->read( 'Auth' ) ) {
                echo $this->Html->link( 'Logout', ['controller' => 'Users', 'action' => 'logout'], [
                    'class' => 'signin',] );
            } else {
                echo $this->Html->link( 'Log In', ['controller' => 'Users', 'action' => 'login'], [
                    'class' => 'signin'] );
                echo $this->Html->link( 'Free Sign Up', ['controller' => 'Users',
                    'action' => 'add'], ['class' => 'signin'] );
            }
            ?>
        </div>
    </nav>
</header>
