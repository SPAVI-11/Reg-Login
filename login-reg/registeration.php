<?php
session_start();
if(isset($_SESSION["user"])){
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equip="X-UA-Compatible" content="IE=edge">
    <title>Registration form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css"> 
    <style>
      div{
        background-color: #28282B;
       
      }
      body {
        background-image: url(https://media.giphy.com/media/U3qYN8S0j3bpK/giphy.gif);
  background-color: #cccccc;
}
h1,p{
    color:white;
}
#logo{ 
	position:fixed; 
	top:0; 
	left:0; 
}
    </style>

   
</head>
<center>
<h1>Registration page</h1>
</center>
<br>
<body>
    <div class="container">
    <div id="logo"> 
	<img src="https://static.vecteezy.com/system/resources/thumbnails/008/124/712/small/initial-letter-p-with-a-swoosh-logo-template-modern-logotype-for-business-and-company-identity-free-vector.jpg"width="150"> 
</div>
        <?php
        if(isset($_POST["submit"])){
            $fullname = $_POST["fullname"];
            $email=$_POST["email"];
            $password=$_POST["password"];
            $passwordRepeat=$_POST["repeat_password"];
            $passwordHash=password_hash($password,PASSWORD_DEFAULT);
            $error=array();
            if(empty($fullname) OR empty($email)OR empty($password)OR empty($passwordRepeat) 
            ){
                   array_push($error,"All fields are required");
        }
        if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
              array_push($error,"Email is not valid");
        }
        if(strlen($password)<8){
            array_push($error,"Password must be atleast 8 characters long");
        }

        if($password !==$passwordRepeat){
            array_push($error,"Password does not match");
        }
        require_once "database.php";
        $sql= "SELECT * FROM users WHERE email='$email'";
        $result=mysqli_query($conn,$sql);
        $rowCount=mysqli_num_rows($result);
        if($rowCount>0){
            array_push($error,"Email already existed");
        }

        if (count($error)>0){
            foreach($error as $errors){
                echo "<div class='alert alert-danger'> $errors</div>";
            }
        }
        else{
           
           $sql = "INSERT INTO users(full_name,email,password) VALUES( ?, ?, ?)";
           $stmt=mysqli_stmt_init($conn);
           $prepareStmt=mysqli_stmt_prepare($stmt,$sql);
           if($prepareStmt){
            mysqli_stmt_bind_param($stmt,"sss",$fullname,$email,$passwordHash);
            mysqli_stmt_execute($stmt);
            echo"<div class='alert alert-success'>Registered succesfully.</div>";
           }
           else{
            die("Something went wrong");
           }
        }
        }
        ?>
        <form action="registeration.php" method="post">
            <div class="form-group">
                <input type="text" name="fullname" class="form-control" placeholder="Full Name">
            </div>
            <div class="form-group">
                <input type="email" name="email" class="form-control" placeholder="Email">
            </div>
            <div class="form-group">
                <input type="password" name="password" class="form-control" placeholder="Password">
            </div>
            <div class="form-group">
                <input type="text" name="repeat_password" class="form-control" placeholder="Repeat password">
            </div>
            <div class="form-btn">
                <input type="submit"class="btn btn-primary" value="Register"name="submit" >
            </div>
        </form>
        <br>
        <div><p>Already registered? <a href="login.php">Login Here</a></p>
    </div>
    </div>
</body>
</html>