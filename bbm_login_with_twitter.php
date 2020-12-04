<?php session_start();
ob_start();

// Include config file and twitter PHP Library
include_once("twitter/twitteroauth.php");
 
define('CONSUMER_KEY', '9IjbsBnnByCQXBxJN61jWN7JZ'); // YOUR CONSUMER KEY
define('CONSUMER_SECRET', 'ZJ6ML7MB2aPxSe7ULVmAxphHHpQ4I6zTTPuYtABL2OtJTDAM69'); //YOUR CONSUMER SECRET KEY 
define('OAUTH_CALLBACK', 'https://mapping.boostbank.com/bstadmin/socialmedia/bbm_login_with_twitter.php');  // Redirect URL 
 

if(isset($_GET['request']))
{
		//Fresh authentication
		$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET);
		$request_token = $connection->getRequestToken(OAUTH_CALLBACK);

		//Received token info from twitter
		$_SESSION['token'] 			= $request_token['oauth_token'];
		$_SESSION['token_secret'] 	= $request_token['oauth_token_secret'];

		//Any value other than 200 is failure, so continue only if http code is 200
		if($connection->http_code == '200')
		{
		//redirect user to twitter
		$twitter_url = $connection->getAuthorizeURL($request_token['oauth_token']);
		header('Location: ' . $twitter_url); 
		}else{
		die("error connecting to twitter! try again later!");
		}
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Login with Twitter</title>

</head>
<body>
<?php
	if(isset($_REQUEST['oauth_token']) && $_SESSION['token'] == $_REQUEST['oauth_token']){

			$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $_SESSION['token'] , $_SESSION['token_secret']);
			$access_token = $connection->getAccessToken($_REQUEST['oauth_verifier']);
			if($connection->http_code == '200')
			{
$params = array('include_email' => 'true', 'include_entities' => 'false', 'skip_status' => 'true');
				$user_data = $connection->get('account/verify_credentials', $params); 
				$result = '<h1>Twitter Profile Details </h1>';
				$result .= '<img src="'.$user_data['profile_image_url'].'">';
				$result .= '<br/>Twitter ID : ' . $user_data['id'];
				$result .= '<br/>Name : ' . $user_data['name'];
				$result .= '<br/>Email ID: ' . $user_data['email'];
				$result .= '<br/>Twitter Username : ' . $user_data['screen_name'];
				$result .= '<br/>Followers : ' . $user_data['followers_count'];
				$result .= '<br/>Follows : ' . $user_data['friends_count'];
				$result .= '<br/>Logout from <a href="bbm_login_with_twitter?logout">Twitter</a>';
                echo '<div>'.$result.'</div>';				
			}else{
			       die("error, try again later!");
			}
			
	}else{
		//Display login button
		
		echo '<br><center><a href="bbm_login_with_twitter.php?request=twitter"><img src="../assets/img/login_button.jpg" /></a></center>';
	}
	
	
	if(array_key_exists('logout',$_GET))
{
	session_start();
	unset($_SESSION['userdata']);
	session_destroy();
	header("Location:bbm_login_with_twitter.php");
}
?>  

</body>
</html>