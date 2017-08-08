/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var socket = null;
var counter = 0;
function getNotification(login = false,counter = 0) {
    if (login !== '') {
        
        socket = io('http://sfsuse.com:3000/', {
            query: {
                id: login
            }
        });
        
        socket.on('messages', function (msg) {
            if (msg.id == login) {
                counter += 1;
                $('#message-counter').addClass('fa-layers-counter');
                $('.fa-layers-counter').html(counter);
            }
        })
}
}





            