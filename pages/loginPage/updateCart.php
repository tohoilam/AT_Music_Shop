<?php

  session_start();

  // NOT USED
  // NOT USED
  // NOT USED

  if (isset($_SESSION['GuestCart']) && isset($_SESSION['UserId'])) {
    $guestCart = $_SESSION['GuestCart'];
    $UserId = $_SESSION['UserId'];

    if (sizeof($guestCart) > 0) {
      $query = "DELETE FROM Cart WHERE UserId = '$UserId'";
      $response = mysqli_query($connection, $query)
        or die("Query Error!".mysqli_error($connection));
      
      foreach($guestCart as $key => $item) {
        $musicId = $item[1];
        $quantity = $item[3];
        $query = "INSERT INTO Cart VALUES (NULL, '$musicId', '$UserId', '$quantity');";
        $response = mysqli_query($connection, $query)
          or die("Query Error!".mysqli_error($connection));
      }

      echo "done";
    }
  }
  else {
    echo "done";
  }