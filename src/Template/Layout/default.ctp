<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
$cakeDescription = 'Group 5 About Page';
?>


<!DOCTYPE html>

<html lang="en">
    <head>
        <!-- css & js file import --> <?= $this->element('header-base'); ?> <!-- css & js file import -->
        <title>CSC648 - Team5 - PictureSque - Home</title>
        <?= $this->Html->css('home-index1.css');?>
    </head>

    <body class="gray-background" style="background: none !important;">
        <div id="app" class="app-wrapper">
            <!-- header - logo & signin  --> <?= $this->element('header'); ?> <!-- header - logo & signin  -->

            <main class="-sidebar-open"> 
                <!-- left side menu  --> <?= $this->element('menu'); ?> <!-- left side menu  -->

                <section id="gallery-container" class="tg-container">
                    <!-- start right side content -->
                    <?= $this->fetch('content') ?>
                    <!-- stop right side content -->
                </section>
            </main>

            <!-- footer --> <?= $this->element('footer'); ?> <!-- footer -->
        </div>
    </body>
</html>