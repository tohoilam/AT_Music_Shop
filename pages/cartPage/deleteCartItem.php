<?php
  session_start();

  $MusicId = $_POST['MusicId'];

  if (isset($_SESSION['UserId'])) {
    $UserId = $_SESSION['UserId'];

    $connection = mysqli_connect('sophia.cs.hku.hk', 'hlto', 'Sph121Ng', 'hlto')
      or die("Connection Error! ".mysqli_connect_error());

    $query = "DELETE FROM Cart WHERE UserId = '$UserId' AND MusicId = '$MusicId';";
    $response = mysqli_query($connection, $query)
      or die("Query Error!".mysqli_error($connection));
    
    echo "done";
  }
  else {
    if (isset($_SESSION['GuestCart'])) {
      $guestCart = unserialize($_SESSION['GuestCart']);

      foreach ($guestCart as $key => $item) {
        if ($item[1] == $MusicId) {
          unset($guestCart[$key]);
        }
      }
      $_SESSION['GuestCart'] = serialize($guestCart);

      echo "done";
    }
    else {
      echo "error";
    }
  }