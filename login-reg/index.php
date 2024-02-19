<?php
session_start();
if(!isset($_SESSION["user"])){
    header("Location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <style>
       
      body{
       
        background-image: url(https://media.giphy.com/media/U3qYN8S0j3bpK/giphy.gif);
        background-color: seashell;
      }
      h1{
        color:white;
      }
      #logo{ 
	position:fixed; 
	top:0; 
	left:0; 
}
      
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome to my Dashboard</h1>
        <div id="logo"> 
	<img src="https://static.vecteezy.com/system/resources/thumbnails/008/124/712/small/initial-letter-p-with-a-swoosh-logo-template-modern-logotype-for-business-and-company-identity-free-vector.jpg"width="150"> 
</div> 
        
        <br>
        <br>
        <img src="https://customers.ai/wp-content/uploads/2020/12/welcome-greeting-message.png"width="500"height="300"alt="image">
        <br>
        <br>
        <center>
        <a href="logout.php" class="btn btn-warning">Logout</a>
    </center>
    </div>
</body>
</html>