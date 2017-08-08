/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if ((login !== '') && (self != 'true')) {
                    $('#contact-button').click(function () {
                        
                        //e.preventDefault();
                        if ($('#msg-box').val().length > 0) {                                               
                            $.ajax({
                                url:url,
                                type: 'POST',
                                data:
                                {
                                    sender_id: login,
                                    receiver_id:receiver,
                                    media_id: media,
                                    message_content: $('#msg-box').val()
                                },
                                        success:function(){
                                            $.notify('Message Sent', {position: 'top left', style: 'bootstrap', className: 'success'});
                                            socket.emit('messages', {id:receiver, content: 'new message'});
                                        }
                            });
                        }
                    });
                

            } else if(self == 'true'){
                $('#contact-button').click(function () {
                    $.notify('Can\'t send message to yourself', {position: 'top left', style: 'bootstrap', className: 'info'});
                });
            }else {
                $('#contact-button').click(function () {
                    $.notify('Please Log in to send message', {position: 'top left', style: 'bootstrap', className: 'info'});
                });
            }
