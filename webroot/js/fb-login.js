/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


  window.fbAsyncInit = function() {
    FB.init({
      appId      : '1411849535597521',
      cookie     : true,
      xfbml      : true,
      version    : 'v2.8'
    });
    FB.AppEvents.logPageView();   
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
   
function checkLoginState() {
  FB.getLoginStatus(function(response) {
    //statusChangeCallback(response);
    var token,name,email,id;
    console.log(JSON.stringify(response));
    if(response.status == 'connected'){
        token = response.authResponse.accessToken;
        id = response.authResponse.userID;
        FB.api('/me',{fields:'name,email'},function(response){
            name = response.name.replace(/\s/g, '');
            email = response.email;
            console.log(name);
            console.log(token);
            console.log(email);
            console.log(id);
            $.ajax({
                                url:url,
                                type: 'POST',
                                data:
                                {
                                    _method: 'POST',
                                    name: name,
                                    email:email,
                                    token: token,
                                    user_id:id
                                },
                                        success:function(res){
                                            window.location.href = response_url;
                                        }
                            });
        })
    }
  });
}