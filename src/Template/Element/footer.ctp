<footer>Member | Privacy Policy | <a href="<?= $this->url->build(['controller' => 'About', 'action' => 'index'])?>"> About Us </a> | Support</footer>

<?php
if ( $this->layout != 'default_no_menu' ) {
    echo $this->Html->script( 'home-scripts-2' );
}
?>