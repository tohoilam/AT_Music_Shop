<?php

  $username = $_POST['username'];
  $password = $_POST['password'];
  session_start();

  $connection = mysqli_connect('sophia.cs.hku.hk', 'hlto', 'Sph121Ng', 'hlto')
    or die("Connection Error! ".mysqli_connect_error());

  $query = "SELECT * FROM Login WHERE UserId = '$username';";
  $response = mysqli_query($connection, $query)
    or die("Query Error!".mysqli_error($connection));

  if (mysqli_num_rows($response) > 0) {
    # There is a match in username
    # Check password
    $item = mysqli_fetch_array($response);
    if ($item['PW'] == $password) {
      # Correct login information
      # Set session and Redirect!
      $_SESSION['UserId']=$item['UserId'];
      echo "done";
    }
    else {
      echo "wrong_password";
    }
  }
  else {
    echo "no_user";
  }
  
  

