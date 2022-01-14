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

      if (isset($_SESSION['GuestCart']) && isset($_SESSION['UserId'])) {
        $guestCart = unserialize($_SESSION['GuestCart']);
        $UserId = $_SESSION['UserId'];
    
        if (sizeof($guestCart) > 0) {
          $query = "DELETE FROM Cart WHERE UserId = '$UserId'";
          $response = mysqli_query($connection, $query)
            or die("Query Error!".mysqli_error($connection));
          
          $query = "INSERT INTO Cart VALUES ";
          
          foreach ($guestCart as $key => $guestItem) {
            $musicId = $guestItem[1];
            $quantity = $guestItem[3];
            if ($key == 0) {
              $query = $query . "(NULL, $musicId, $UserId, $quantity)";
            }
            else {
              $query = $query . ", (NULL, $musicId, $UserId, $quantity)";
            }
          }

          $response = mysqli_query($connection, $query)
            or die("Query Error!".mysqli_error($connection));

          unset($_SESSION['GuestCart']);
        }
        echo "done";
      }
      else {
        echo "done";
      }
    }
    else {
      echo "wrong_password";
    }
  }
  else {
    echo "no_user";
  }
  
  

