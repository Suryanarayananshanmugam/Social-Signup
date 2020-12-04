<?php session_start();
ob_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<center><a href id="LoginWithAmazon">
<img border="0" alt="Login with Amazon"src="../assets/img/amazon_log.png"width="156" height="32" />
</a></center>
<div id="amazon-root"></div>
  
 
    <!-- CORE PLUGINS-->
    <script src="assets/vendors/jquery/dist/jquery.min.js"></script>
    
    <!-- CORE SCRIPTS-->
    <script src="assets/js/app.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.6.11/core.min.js"></script>
    
    
<script type="text/javascript">
 

  window.onAmazonLoginReady = function() {
    amazon.Login.setClientId('amzn1.application-oa2-client.dfbf0154021444649ab1c5d5930899ea');
  };
  (function(d) {
    var a = d.createElement('script'); a.type = 'text/javascript';
    a.async = true; a.id = 'amazon-login-sdk';
    a.src = 'https://assets.loginwithamazon.com/sdk/na/login1.js';
    d.getElementById('amazon-root').appendChild(a);
  })(document);


  document.getElementById('LoginWithAmazon').onclick = function() {
    options = { scope : 'profile' };
    amazon.Login.authorize(options, 'https://mapping.boostbank.com/bstadmin/socialmedia/bbm_amazon_handle.php');
    return false;
  };


 document.getElementById('Logout').onclick = function() {
    amazon.Login.logout();
};
</script>
 