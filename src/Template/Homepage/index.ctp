<?php $this->layout = false; ?>

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
					<?= $this->render('index_content'); ?>
				<!-- stop right side content -->
			</section>
		</main>
		
		<!-- footer --> <?= $this->element('footer'); ?> <!-- footer -->
	</div>
</body>
</html>
