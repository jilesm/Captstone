<?php

if (isset($_POST['submit'])){

    require 'dbh.inc.php';

    $uid = $_POST['uid'];
    $pwd = $_POST['pwd'];

    //Error Hanlers
    //Check if inputs are empty

    if (empty($uid) || empty($pwd)) {
        header ("Location: ../index.php?login=empty1");
         exit();
    }

    else {
        //Check if username exists in the database USING PREPARED STATEMENTS
        $sql = "SELECT * FROM testuser WHERE user_uid='$uid'";
        //Creae a prepared statement
        $stmt = mysqli_stmt_init($conn);
        //Check if prepared statement fails
        if(!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../index.php?error=sqlerror");
            exit();
        }
        //If the prepared statement didn't fail, then continue
			else {
				//Bind parameters/data to the placeholder (?) in our $sql
				mysqli_stmt_bind_param($stmt, "s", $uid);

				//Run query in database
				mysqli_stmt_execute($stmt);
        //Get results from query
	      $result = mysqli_stmt_get_result($stmt);

          //If we had a result, which means the username does exist, then assign the database row data to $row.
          if ($row = mysqli_fetch_assoc($result)) {
              //De-hashing the password using the password provided by the user, and the password from the database, to see if they match.
              $hashedPwdCheck = password_verify($pwd, $row['user_pwd']);
                
              //If they didn't match!
              if ($hashedPwdCheck == false) {
                  header("Location: ../index.php?error=wrongpwd");
                  exit();
              }
              //If they did match!
              elseif ($hashedPwdCheck == true) {
                //Session Start
                session_start();
                  //Set SESSION variables and log user in
                  $_SESSION['u_id'] = $row['user_id'];
                  $_SESSION['u_uid'] = $row['user_uid'];
                  header("Location: ../home.php");
                  exit();
              }
    } 
    else {
      header("Location: ../index.php?login=wronguidpwd");
          exit();
        }
    }
  }

  //Close the prepared statement
  mysqli_stmt_close($stmt);

} 
else {
  header("Location: ../index.php?login=error5");
  exit();
}
