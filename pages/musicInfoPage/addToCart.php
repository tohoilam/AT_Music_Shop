<?php
  session_start();

  $mode = $_POST['mode'];
  $musicId = $_POST['musicId'];
  $quantity = $_POST['quantity'];
  
  if ($mode == 'user') {
    $connection = mysqli_connect('sophia.cs.hku.hk', 'hlto', 'Sph121Ng', 'hlto')
      or die("Connection Error! ".mysqli_connect_error());

    if (isset($_SESSION['UserId'])) {
      $userId = $_SESSION['UserId'];

      $query = "INSERT INTO Cart VALUES (NULL, '$musicId', '$userId', '$quantity');";
      $response = mysqli_query($connection, $query)
        or die("Query Error!".mysqli_error($connection));

      echo "done";
    }
    else {
      echo "No_UserId_In_Session";
    }
  }
  else if ($mode == 'guest') {
    if (! isset($_SESSION['GuestCart'])) {
      $data = array(array(0, $musicId, $userId, $quantity));
      $_SESSION['GuestCart'] = serialize($data);
    }
    else {
      $data = unserialize($_SESSION['GuestCart']);
      array_push($data, array(0, $musicId, $userId, $quantity));
      $_SESSION['GuestCart'] = serialize($data);
    }

    echo "done";
  }
  

