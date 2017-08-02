<?php
$this->layout = 'default_no_menu';
$images_type = "jpg|png";
$videos_type = "mp4";
?>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php
            if ($item != "No Result Found") {
                echo $item->media_title;
            } else {
                echo 'Product Missing';
            }
            ?>
        </title>
        <?= $this->Html->meta('icon') ?>
        <?= $this->Html->css('bootstrap.css') ?>
        <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
        <?= $this->Html->script('bootstrap.min'); ?>
        <?= $this->Html->script('notify.js'); ?>
        <?= $this->Html->css('itemStyle.css')?>
    </head>
    <body>
        <?php if ($item != "No Result Found") { ?>
            <div class="container">

                <br>
                <!-- Main Product -->
                <div class="row">
                    <!-- Image Container-->
                    <div class="col-md-6 col-md-offset-2 col-sm-6 col-sm-offset-1">                        
                        <?php
                        //Checking File type Image / Video
                        if (strpos($images_type, substr($item->media_link, strlen($item->media_link) - 3)) !== false) {
                            ?>
                            <span  style="font-size: 2em; color:white;position:absolute; margin :50% 20% 25% 30%; text-align: center">Click to Enlarge</span>
                            <img id="imgbox" class="img-responsive img-thumbnail" src="<?php echo $this->url->build(['controller' => 'Item', 'action' => 'image', '?' => ['id' => $item->media_id]]) ?>" data-toggle="modal" data-target="#lbModal" alt="<?= $item->media_title ?>">
                            <?php
                        } else if (strpos($videos_type, substr($item->media_link, strlen($item->media_link) - 3)) !== false) {
                            echo $this->Html->media('/img/' . $item->media_link, [
                                'controls',
                                'controlsList' => 'nodownload'
                            ]);
                        }
                        ?>
                    </div>

                    <!-- Detail Container-->
                    <div class="col-md-3 col-sm-3" id="detail-container">
                        <h2><?= $item->media_title ?></h2>
                        <hr>
                        <h3><span style="color:#f49842">$<?= $item->price ?></span></h3>

                        <button type="button" id="contact-button" class="btn btn-warning btn-lg text-center">Contact Owner</button>
                        <hr>
                        <h4>Author:&nbsp;<span style="color:#7ae0ff"><?= $user->username ?></span></h4>
                        <p style="font-size:1em">Upload date:&nbsp;<?= date('F d,Y', strtotime($item->upload_date)) ?></p>
                        <p style="font-size:1em">Download:&nbsp;<?= $item->sold_count ?></p>
                        <p style="font-size:1em">Description:&nbsp;<?= $item->media_desc ?></p>
                    </div>
                </div>
                <!-- Main Product -->
            </div>            

            <!--Modal lightbox-->
            <div class="modal fade" id="lbModal">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <img id="lb-image"class="img-responsive" src="<?php echo "http://www." . $this->request->env('HTTP_HOST') . strtok($this->request->env('REQUEST_URI'), '?') . '/image?id=' . $item->media_id; ?>">
                        </div>
                    </div>
                </div>
            </div>
            <?php
        } else {
            ?>
            <div class="container">
                <h1 class="text-center" style="position:relative;margin:10% 0 10% 0"><span>Oops! There is nothing here, looks like you are in a wrong place!</span></h1>
                <div class="col-md-1 col-md-offset-5 col-lg-1 col-lg-offset-5 col-sm-1 col-sm-offset-5">
    <?= $this->Html->link('Go Back', '/', ['class' => 'btn btn-primary btn-lg text-center']) ?>
                </div>

            </div>
            <?php
        }
        ?>
        <!-- Suggestion -->
        <div class="container"  id="suggest-container">
            <div class="row">
                <h4 style="margin-left:3%">Images You might like</h4>
            </div>
            <div class="row">
                <?php foreach($similar_items as $similar_item){ ?>
                    <div class="col-lg-2 col-md-2 col-sm-2">
                        <a href="<?= $this->url->build((['controller' => 'Item', 'action' => 'index', '?' => ['id' => $similar_item->media_id]])) ?>">
                            <img class="img-thumbnail"  src="<?= $this->url->build((['controller' => 'Item', 'action' => 'image', '?' => ['id' => $similar_item->media_id],'resize'=> '250x250']))?>">
                        </a>
                    </div>
                <?php } ?>
                
            </div>
        </div>
        <!-- Suggestion -->
        <script>         
        if(login !== ''){
            $('#contact-button').click(function () {                    
                    socket.emit('messages', {id:<?=$user->user_id?>, content: 'new message'});  
                    $.notify('Message Sent',{position:'top left',style:'bootstrap',className:'success'});
            });
        }else{
            $('#contact-button').click(function () {
                    $.notify('Please Log in to send message',{position:'top left',style:'bootstrap',className:'info'});
            });
            
        }
        </script>        
    </body>
</html>
