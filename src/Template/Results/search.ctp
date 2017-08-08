<!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
<link rel="shortcut icon" href="favicon.ico">

<!-- Google Webfonts -->
<link href='http://fonts.googleapis.com/css?family=Roboto:400,300,100,500' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>

<!-- Animate.css -->
<link rel="stylesheet" href="css/animate.css">
<!-- Icomoon Icon Fonts-->
<link rel="stylesheet" href="css/icomoon.css">
<!-- Magnific Popup -->

<link rel="stylesheet" href="css/magnific-popup.css">
<!-- Salvattore -->
<link rel="stylesheet" href="css/salvattore.css">
<!-- Theme Style -->
<link rel="stylesheet" href="css/style.css">
<!-- Modernizr JS -->
<script src="js/modernizr-2.6.2.min.js"></script>
<?php echo $this->Html->css('home-index1');?>
<!-- FOR IE9 below -->
<!--[if lt IE 9]>
<script src="js/respond.min.js"></script>
<![endif]-->

<h1 class="page-header">
    <?php echo $resultReport?>

</h1>
<div  id="gallery-container" class="tg-gallery">

    <div id="fh5co-main">
        <div class="container">

            <div class="row">

                <div id="fh5co-board" data-columns>
                    <?php foreach ($results as $media): ?>
                    
                        <div class="item">
                            <div class="animate-box">
                                <a href="<?= $this->Url->build(['controller' => 'Item', 'action' => 'image', '?' => ['id' => $media->media_id]])?>" class="image-popup fh5co-board-img">
                                <?php if($media->type_id == 1){  echo $this->Html->image('/img/'.$media->media_link);}
                                elseif($media->type_id == 2){ 
                                    echo $this->Html->media('/img/' . $media->media_link, [
                                'controls',
                                'controlsList' => 'nodownload',
                                'class' => 'img-thumbnail embed-responsive-item',
                                'style' => 'margin-top:25%'
                                ]);} ?></a >  
                            </div>
                            <div class="fh5co-desc">
                                Title: <?= $media->media_title ?><br>
                                Author Name: <?= $media->u['username'] ?><br>
                                Price: <?= $media->price ?> dollars <br>
                                <?php echo $this->Html->link(__('View More Info and Buy it'), ['controller' => 'Item', 'action' => 'index', '?' => array('id' => $media->media_id)]); ?>

                            </div>
                        </div>
                    <?php endforeach; ?>

                </div>
            </div>
        </div>
    </div>
</div>



<!-- jQuery -->
<script src="js/jquery.min.js"></script>
<!-- jQuery Easing -->
<script src="js/jquery.easing.1.3.js"></script>
<!-- Bootstrap -->
<script src="js/bootstrap.min.js"></script>
<!-- Waypoints -->
<script src="js/jquery.waypoints.min.js"></script>
<!-- Magnific Popup -->
<script src="js/jquery.magnific-popup.min.js"></script>
<!-- Salvattore -->
<script src="js/salvattore.min.js"></script>
<!-- Main JS -->
<script src="js/main.js"></script>