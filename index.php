<?php
        session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="login.css" rel="stylesheet">
    <title>Paws With a Cause</title>
</head>
<body>
<div class="image-wrap">
        <img src="images/paws.jpg" alt="Paws Logo" width="250" height="250">
<div class="login-wrap">
        <?php
        //Here is our login form!
	
    
                echo '<form action="includes/login.inc.php" method="POST">
                <input type="text" name="uid" value="" placeholder="Enter Username">
                <input type="password" name="pwd" value= "" placeholder="Enter Password">
                <button type="submit" name = "submit" class="btn">Login</button>
                </form>';
                
      
?>
      
</div>
</body>
</html>