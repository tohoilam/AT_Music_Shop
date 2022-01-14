<?php

  session_start();
  
  $connection = mysqli_connect('sophia.cs.hku.hk', 'hlto', 'Sph121Ng', 'hlto')
    or die("Connection Error! ".mysqli_connect_error());

  $username = $_GET['username'];
  $password = $_GET['password'];

  $query = "SELECT * FROM Login WHERE UserId = '$username';";
  $response = mysqli_query($connection, $query)
    or die("Query Error!".mysqli_error($connection));

  if (mysqli_num_rows($response) > 0) {
    # There is a match in username
    echo "user_exists";
  }
  else {
    $query = "INSERT INTO Login VALUES ('$username', '$password');";
    $response = mysqli_query($connection, $query)
      or die("Query Error!".mysqli_error($connection));
    
    # Redirect!
    // $_SESSION['UserId']=$username;
    echo "done";
  }
  
  

