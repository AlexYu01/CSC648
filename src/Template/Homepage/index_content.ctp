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