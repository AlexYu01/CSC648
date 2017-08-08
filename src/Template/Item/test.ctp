
<?php $this->layout = 'default_no_menu'; ?>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?= $this->Html->css('bootstrap.min.css') ?>        
        <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.0.3/socket.io.js"></script>
        <?= $this->Html->script('notify.js') ?>
    </head>
    <body>        
        <div>TODO write content
        </div>
        <div id="messages">
        </div>
        <button class="btn btn-info">test button</button>
        <script>
            <?php
        if ($this->request->session()->read('Auth')) {
            $authUser = $this->request->session()->read('Auth');
        } else {
            $authUser['User']['user_id'] = 'false';
        }
        ?>
            var login = <?= $authUser['User']['user_id'] ?>;
            if (login !== false) {
                const socket = io('http://sfsuse.com:3000/', {
                    query: {
                        id:<?= $authUser['User']['user_id']; ?>
                    }
                });

                $('.btn.btn-info').click(function () {
                    socket.emit('messages', {id:<?= $authUser['User']['user_id']; ?>, content: 'new message'});
                });

                socket.on('messages', function (msg) {
                    if (msg.id == <?= $authUser['User']['user_id']; ?>) {
                        $('#messages').append($('<li>').text(msg.content))
                        //$.notify('New Message Received',{position:'top right'})
                        $('#message-counter').addClass('fa-layers-counter');
                    }
                })
            }
        </script>
    </body>
</html>
