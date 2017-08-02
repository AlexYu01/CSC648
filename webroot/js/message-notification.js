/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var socket = null;
function getNotification(login = false) {
    if (login !== '') {
        
        socket = io('http://sfsuse.com:3000/', {
            query: {
                id: login
            }
        });
        
        var counter = 0;
         
        socket.on('messages', function (msg) {
            if (msg.id == login) {
                //$('#messages').append($('<li>').text(msg.content))
                //$.notify('New Message Received',{position:'top right'})
                counter += 1;
                $('#message-counter').addClass('fa-layers-counter');
                $('.fa-layers-counter').html(counter);
            }
        })
}
}





            