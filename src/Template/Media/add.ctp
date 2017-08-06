<?php $this->layout = "default_no_menu"; ?>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= $this->Flash->render(); ?>
        <?= $this->Html->script( 'https://s.codepen.io/assets/libs/modernizr.js' ) ?>

        <?= $this->Html->css( 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css' ) ?>
        <?= $this->Html->css( 'bootstrap-theme.min' ) ?>

        <?= $this->Html->css( 'https://cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.0/css/bootstrapValidator.min.css' ) ?>

        <?= $this->Html->script( 'jquery.min' ) ?>
        <?= $this->Html->script( 'bootstrap.min' ) ?>
        <?= $this->Html->script( 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-validator/0.4.5/js/bootstrapvalidator.min.js' ) ?>

        <!-- drag and drop and file validation-->
        <?= $this->Html->css( 'dropzone' ) ?>
        <?= $this->Html->script( 'dropzone' ) ?>

        <!-- Input validation -->
        <?= $this->Html->script( 'media_form_validation' ) ?>


        <!-- used for making thumbnail of the video -->
        <?= $this->Html->script( 'rsvp' ) ?>
        <?= $this->Html->script( 'frame-grab' ) ?>
    </head>

    <style>
        body {
            background: #333;
        }

        .dropzone .dz-preview .dz-image {
            width: 100%;
            height: auto;

        }

        #previews {
            text-align: center;
            border-radius: 20px;
        }

        .dropzone .dz-preview .dz-progress {
            height: 3%;
            left: 10%;
            top: 47%;
            width: 80%;
            margin-left: 0px;
        }

        img {
            width: 100%;
            height: auto;
        }

        .dropzone {
            height: 100%;
            width: 100%;
            border: 2px dashed #0087F7;
            border-radius: 5px;
        }

        .dropzone.dz-drag-hover {
            border: 2px dashed #0087F7;
            border-radius: 5px;
            background: #E3F2FD;
        }
    </style>

    <body>
        <div class="container">

            <?=
            $this->Form->create( $newMedia, [
                'type' => 'file', 'enctype' => 'multipart/form-data',
                'id' => 'media', 'class' => 'form-horizontal dropzone'] )
            ?>
            <fieldset>

                <!-- Form Name -->

                <h2 class="text-center">Selling Form</h2>

                <!-- Text input-->
                <div class="container-fluid">
                    <div class="row">

                        <div id="previews" class="dropzone-previews"></div>
                    </div>
                </div>
                <div class="dz-message" data-dz-message><span>Drag and drop files or click here<br>Max 8MB file. Supported formats: jpg, jpeg, gif, png, mp4</span></div>

                <div class="form-group">
                    <label class="col-md-4 control-label">Title</label>

                    <div class="col-md-4 inputGroupContainer">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-picture"></i></span>
                            <?=
                            $this->Form->control( 'media_title', ['class' => 'form-control',
                                'label' => false] )
                            ?>
                        </div>
                        <small class="form-text text-muted">30 characters max</small>
                    </div>
                </div>
                <!-- Text input-->

                <div class="form-group">
                    <label class="col-md-4 control-label">Description</label>  
                    <div class="col-md-4 inputGroupContainer">            
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
                            <?=
                            $this->Form->control( 'media_desc', ['class' => 'form-control',
                                'rows' => '3', 'label' => false] )
                            ?>
                        </div>
                    </div>
                </div>

                <!-- Text input-->

                <div class="form-group">
                    <label class="col-md-4 control-label" >Genre</label> 
                    <div class="col-md-4 inputGroupContainer">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
                            <?=
                            $this->Form->select( 'genre_id', $genreList, [
                                'class' => 'form-control selectpicker', 'label' => false] )
                            ?>
                        </div>
                    </div>
                </div>

                <!-- Drop down-->

                <div class="form-group">
                    <label class="col-md-4 control-label" >Price</label> 
                    <div class="col-md-4 inputGroupContainer">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-usd"></i></span>
                            <?=
                            $this->Form->control( 'price', ['class' => 'form-control',
                                'type' => 'number', 'label' => false] )
                            ?>
                        </div>
                    </div>
                </div>

                <!-- Fall back for browsers that cannot support drag & drop-->

                <div class="fallback">
                    <input name="file" type="file" />
                </div>
                <!-- Success message -->
                <!--<div class="alert alert-success" role="alert" id="success_message">Success <i class="glyphicon glyphicon-thumbs-up"></i>Text here</div> -->

                <!-- Button -->
                <div class="form-group">
                    <label class="col-md-4 control-label"></label>
                    <div class="col-md-4">
                        <button id="submitBtn" class="btn btn-primary">Post! <span class="glyphicon glyphicon-upload"></span></button>
                    </div>
                </div>

            </fieldset>
            <?= $this->Form->end(); ?>
        </div>
        <!-- /.container -->


        <script>

            /* Input validation taken care of by media_form_validation.js */

            Dropzone.options.media = {
                maxFiles: 2, // for thumbnail
                maxFilesize: 8,
                timeout: 3600000, // user has 1 hour to upload a file at max 8 MB
                acceptedFiles: "image/*,video/mp4",
                thumbnailWidth: 500,
                thumbnailHeight: 500,
                previewsContainer: "#previews",
                addRemoveLinks: true,
                autoProcessQueue: false,
                autoDiscover: false,
                clickable: true,

                init: function () {

                    var myDropzone = this;

                    // Files are uploaded when user clicks on submitBtn and all fields are valid
                    $("#submitBtn").on('click', function (e) {
                        var validator = $('#media').data('bootstrapValidator');
                        validator.validate();
                        if (validator.isValid()) {
                            e.preventDefault();
                            myDropzone.processQueue();
                        }
                    });

                    this.on("addedfile", function () {
                        if (this.files[1] != null) {
                            this.removeFile(this.files[0]);
                        }
                    });

                    this.on("error", function (file, message) {
                        alert(message);
                        this.removeFile(file);
                    });


                    // create thumbnail for video
                    self = this;
                    this.on("addedfile", function (file) {

                        // check file extension, see:
                        // http://stackoverflow.com/questions/190852/how-can-i-get-file-extensions-with-javascript
                        var comps = file.name.split(".");
                        if (comps.length === 1 || (comps[0] === "" && comps.length === 2)) {
                            return;
                        }
                        var ext = comps.pop().toLowerCase();
                        if (ext == 'mov' || ext == 'mpeg' || ext == 'mp4' || ext == 'wmv') {

                            // create a hidden <video> element with video file.
                            FrameGrab.blob_to_video(file).then(
                                    function videoRendered(videoEl) {

                                        // extract video frame at 1 sec into a 500px image and
                                        // set to the <img> element.
                                        var frameGrab = new FrameGrab({video: videoEl});
                                        frameGrab.grab('img', 1, 500).then(
                                                function frameGrabbed(itemEntry) {
                                                    self.emit('thumbnail', file, itemEntry.container.src);
                                                },
                                                function frameFailedToGrab(reason) {
                                                    console.log("Can't grab the video frame from file: " +
                                                            file.name + ". Reason: " + reason);
                                                }
                                        );
                                    },
                                    function videoFailedToRender(reason) {
                                        console.log("Can't convert the file to a video element: " +
                                                file.name + ". Reason: " + reason);
                                    }
                            );
                        }
                    });
                },
                success: function (file, response) {
                    window.location.replace('<?=
            $this->url->build( ['controller' => 'Media',
                'action' => 'posts'] )
            ?>');
                },

                /*error: function (file, errormessage, xhr) {
                 if (xhr) {
                 var response = JSON.parse(xhr.responseText);
                 alert(response.message);
                 }
                 },*/
                error: function (file, response) {
                    file.previewElement.classList.add("dz-error");
                }
            };
        </script>
    </body>
</html>