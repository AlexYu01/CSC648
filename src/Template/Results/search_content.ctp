
<h1 class="page-header">
						Pick the Photography<br>you love
					</h1>
					<ul class="tg-gallery">
						<?php foreach ($productData as $media): ?>
						<li class="tg-template">
							<div class="tg-thumbnail ">
								<i><img src="img/circles.svg"></i>
								<?= $this->Html->image($media->media_link, ['alt' => $media->media_title, 'class' => 'tg-template-img']) ?>
								<aside class="tg-hover">
									<input type="checkbox" class="tg-hover-toggle"
										id="tg-hover-toggle-<?= $media->media_id ?>">
									<h5>
										Price: <b>$<?= $media->price ?></b>
									</h5>
		
									<a class="tg-button -blue" href="#" target="_blank"><span>View Detail</span></a>
									<label for="tg-hover-toggle-<?= $media->media_id ?>" class="tg-info-link">Info </label>
		
									<aside class="tg-information ">
										<div class="tg-info-box">
											<h5>
												<?= $media->media_title ?>
											</h5>
											<p>Photographers, all creative types</p>
											<h5>Description</h5>
											<p>
												<?= $media->media_desc ?>
											</p>
										</div>
									</aside>
								</aside>
							</div> <span class="tg-template-name"> <?= $media->media_title ?></span>
						</li>
						<?php endforeach; ?>
					</ul>
		
					<div id="navpagination" class="pagination pagination-large">
						<ul class="pagination">
							<?= $this->Paginator->next(' Show more ') ?>
						</ul>
					</div>
					
					<script>
						$(function() {
							var $container = $('#gallery-container');
			
							$container
									.infinitescroll({
										navSelector : '.pagination', // selector for the paged navigation 
										nextSelector : '.next a', // selector for the NEXT link (to page 2)
										itemSelector : '.tg-gallery', // selector for all items you'll retrieve
										debug : false,
										dataType : 'html',
										loading : {
											finishedMsg : "<div style='text-align:center;'>oops, no more images.</div>",
											img : 'img/spinner.gif'
										}
									});
						});
					</script>
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        

<html>
    <style type="text/css">
        body{margin: 0;padding: 0;}
        #filter{ width:210px; height: 1300px; background: #ffffff;float: left;}
        #resultField{ width:83%; height: 1300px; background: #ffffff;float: right;} 
        #titleLink{font-size: larger; font-style: italic; font-weight: 800;}
        
        * {
            margin: 0;
            padding: 0;
        }

        body {
            background: url(../img/bg5.jpg);
        }

        #items {
            width: 1060px;
            margin: 0 auto;
            border: 1px solid lightpink;
        }

        .item {
            border: 1px solid lightpink;
            width: 200px;
            color: purple;
            font-size: 30px;
            font-weight: bolder;
            margin: 5px;
            text-align: center;
            opacity: 0.8;
        }

        img {
            width: 200px;
        }
    </style>
    <style>
        .itemDisplay-left{float:left ;wigth: 300px;height: 300px;display: block;border: solid;}
        .itemDisplay img{width:100%;height:100%;}
        .itemDisplay-right{float: right; width: 600px;height: 300px;display: block;border: solid;}
        .pagination{font-size: larger;}

    </style>
    

    
    <body>
        
        <div id="items">
            <?php foreach ($results as $media): ?>
                <p class="item"><?= $this->Html->image($media->media_link, ['alt' => $media->media_title, 'height' => '200px', 'width' => '200px']) ?></p>
            <?php endforeach; ?>    
        </div>   
        
        <a href="Handler1.ashx" id="next">下一页</a>
    <script src="js/jquery-3.1.1.js" type="text/javascript" charset="utf-8"></script>
    <!--插件的引用-->
    <script src="js/masonry.pkgd.min.js" type="text/javascript"></script>
    <script src="js/imagesloaded.pkgd.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="js/jquery.infinitescroll.min.js"></script>
    
        
        
        
        
        
        
        
    <div id="resultField">
        <h3><?php 
            $session = $this->request->session();
            echo $session->read('searchResults');
        ?>
        </h3>
        
        <table>
            <tr>
                <th>Media</th>
                <th>Detail</th>
            </tr>
            <?php foreach ($results as $media): ?>
            <tr height='200px'>
                <td><?= $this->Html->image($media->media_link, ['alt' => $media->media_title, 'height' => '200px', 'width' => '200px']) ?></td>
                <td>
                    <div id="titleLink"><?= $this->Html->link(__($media->media_title),['controller'=>'Item','action'=>'index',$media->media_id]) ?></div>  
                    <div id="titleLink">Author Id: <?php echo $media->author_id ?></div> 
                    <div id="titleLink">Author Name: <?= $this->Html->link(__($media->u['username']),['controller'=>'Author','action'=>'index',$media->price]) ?></div>
                    <div id="titleLink">Description: <?php echo $media->media_desc?></div>
                    <div id="titleLink">Price: <?php echo $media->price ?> dollars</div>
                </td>
            </tr>       
        <?php endforeach; ?>
        </table>
  
    </div>

   
    </body>
</html>



<?php 
            $session = $this->request->session();
            echo $session->read('searchResults');
        ?>



<span class="tg-template-name"><?= $this->Html->link(__($media->media_title),['controller'=>'Item','action'=>'index',$media->media_id]) ?>