<?php
require_once 'google/vendor/autoload.php';


 
// init configuration
$clientID = '746879483801-cnq4hhbe016d5oko7lbqh1na9ldtvo78.apps.googleusercontent.com';
$clientSecret = 'oCBju_f841qcuF8epeYCUPQp';
$redirectUri = 'https://mapping.boostbank.com/bstadmin/socialmedia/bbm_login_with_google.php';
  
// create Client Request to access Google API
$client = new Google_Client();
$client->setClientId($clientID);
$client->setClientSecret($clientSecret);
$client->setRedirectUri($redirectUri);
$client->addScope("email");
$client->addScope("profile");
 
// authenticate code from Google OAuth Flow
if (isset($_GET['code'])) {
  $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
  $client->setAccessToken($token['access_token']);
  $client->setClientSecret($clientSecret);//Clave Auth Google

  
  // get profile info
  $google_oauth = new Google_Service_Oauth2($client);
  $google_account_info = $google_oauth->userinfo->get();
  // echo "<pre>";
  //print_r($google_account_info);
 
 echo  $email =  $google_account_info->email;
 echo "<br>";
 echo  $name =  $google_account_info->name;
 
  // now you can use this profile info to create account in your website and make user logged in.
   }



else {
  echo "<a href='".$client->createAuthUrl()."'><img src='google/google-login-image.png' style='width: 16%; margin-top: 100px;margin-left: 40%;'></a>";
}
?>

