window.fbAsyncInit = function() {
    FB.init({
        appId      : '783560558354464',
        xfbml      : false,
        version    : 'v2.1'
    });
};

(function(d, s, id){
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) {return;}
js = d.createElement(s); js.id = id;
js.src = "//connect.facebook.net/en_US/sdk.js";
fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

$(function() {
    $('.HMI-share').click(function(e) {
        e.preventDefault();
        if ($(this).hasClass('HMI-share-facebook')) {
            // Share to Facebook
            url = $(this).attr('href');
            FB.getLoginStatus(function(response) {
                if (response.status === 'connected') {
                    var uid = response.authResponse.userID;
                    var accessToken = response.authResponse.accessToken;
                    FB.api(
                        'me/honeymayi:answer',
                        'post',
                        {
                            access_token: accessToken,
                            question: url
                        },
                        function(response) {
                            // handle the response
                            if(response.id)
                                console.log(response.id+ " Response" );
                        }
                    );
                }else if (response.status === 'not_authorized') {
                    // the user is logged in to Facebook,
                    // but has not authenticated your app
                }else {
                    // the user isn't logged in to Facebook.
                }
            });
        }
        return false;
    });
});