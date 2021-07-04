<?php
session_start();

require_once('google-calendar-api.php');
require_once('settings.php');

//Google passes a parameter 'code' in the Redirect Url
if(isset($_GET['code'])) {
	try {
		$capi = new GoogleCalendarApi();
		
		// Get the access token 
		$data = $capi->GetAccessToken(CLIENT_ID, CLIENT_REDIRECT_URL, CLIENT_SECRET, $_GET['code']);
		
		// Save the access token as a session variable
		$_SESSION['access_token'] = $data['access_token'];

		// Redirect to the page where user can create event
		header('Location: profile.php');
		exit();
	}
	catch(Exception $e) {
		echo $e->getMessage();
		exit();
	}
}

?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<style type="text/css">

#logo {
	text-align: center;
	width: 200px;
    display: block;
    margin: 100px auto;
    border: 2px solid #2980b9;
    padding: 10px;
    background: none;
    color: #2980b9;
    cursor: pointer;
    text-decoration: none;
}
*{
    padding: 0;
    margin: 0;
    font-family: Cursive;
}
body{
    background-image: url('./img/laptop.jpg');
    background-repeat: no-repeat;
    background-size: 100vw 100vh;
}
.navibar{
    background-color: red;
}
.navibar ul{
    display: flex;
    flex-direction: row;

}
.navibar ul li{
    list-style: none;

}
.container{
    width: 50%;
    float: left;

    margin-top: 10%;

}
.container h1{
    color: white;
    text-align: center;
    font-family: Cursive;

    margin-bottom: 15px;


}

.signincontain{
    width: 40%;
    margin-left: 30%;
    margin-top: 40px;

}
.signincontain:hover{
    cursor: pointer;
}
.signincontain img{
    width: 100%;
    height: 100%;
}

</style>
</head>

<body>


<?php
$login_url = 'https://accounts.google.com/o/oauth2/auth?scope=' . urlencode('https://www.googleapis.com/auth/calendar') . '&redirect_uri=' . urlencode(CLIENT_REDIRECT_URL) . '&response_type=code&client_id=' . CLIENT_ID . '&access_type=online';
?>

<!-- <div class="navibar">
    <ul>
        <li>hi </li>
        <li>hi </li>
        <li>hi </li>
    </ul>
</div> -->
<div   class="container">
    <h1>Tired Of Missing Coding Contests...</h1>
    <h1>Remembering thier dates and time...</h1>
    <h1>Wish Someone would have reminded you...</h1>
    <h1>HOW ABOUT YOUR OWN CALENDAR???</h1>


    <div onclick="location.href='<?= $login_url ?>';" class="signincontain">
        <img src="./img/singnin.png" />
    </div>
<div>


</div>





</body>
</html>