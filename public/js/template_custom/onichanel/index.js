// function checkLoginFacebook() {
//     $.ajaxSetup({cache: true});
//     $.getScript('https://connect.facebook.net/en_US/sdk.js', function () {
//         FB.init({
//             appId: '735548903901348',
//             version: 'v2.7'
//         });
//         // $('#loginbutton,#feedbutton').removeAttr('disabled');
//         console.log('check');
//         // FB.getLoginStatus(updateStatusCallback);
//     });
// }
// async function checkLoginFacebook() {
//     let method = 'get',
//         url = 'facebook.auth',
//         params = null,
//         data = null;
//     await axiosTemplate(method, url, params, data);
// }

function statusChangeCallback(response) {  // Called with the results from FB.getLoginStatus().
    console.log('statusChangeCallback');
    console.log(response);                   // The current login status of the person.
    if (response.status === 'connected') {   // Logged into your webpage and Facebook.
        var tokenFacebook = response.authResponse.accessToken;
        console.log(tokenFacebook);
        testAPI();
    } else {                                 // Not logged into your webpage or we are unable to tell.
        // document.getElementById('status').innerHTML = 'Please log ' +
        //     'into this webpage.';
    }
}


function checkLoginState() {               // Called when a person is finished with the Login Button.
    FB.getLoginStatus(function(response) {   // See the onlogin handler
        statusChangeCallback(response);
    });
}


window.fbAsyncInit = function() {
    FB.init({
        appId      : '2806048202996656',
        cookie     : true,
        xfbml      : true,
        version    : 'v8.0'
    });

    FB.getLoginStatus(function(response) {   // See the onlogin handler
        statusChangeCallback(response);
    });

};

function testAPI() {                      // Testing Graph API after login.  See statusChangeCallback() for when this call is made.
    console.log('Welcome!  Fetching your information.... ');
    FB.api('/me', function(response) {
        console.log(response);
        console.log('Successful login for: ' + response.name);
        // document.getElementById('status').innerHTML =
        //     'Thanks for logging in, ' + response.name + '!';
    });
}

$(function () {
    $('#design-wizard .steps li').css('position', 'unset');
    $('#design-wizard .steps li a').css({'border-radius': '50%'});
});
