<?php
  session_start();

  $mode = $_GET['mode'];
  $musicId = $_GET['musicId'];
  $quantity = $_GET['quantity'];
  
  if ($mode == 'user') {
    $connection = mysqli_connect('sophia.cs.hku.hk', 'hlto', 'Sph121Ng', 'hlto')
      or die("Connection Error! ".mysqli_connect_error());

    if (isset($_SESSION['UserId'])) {
      $userId = $_SESSION['UserId'];
      $query = "SELECT * FROM Cart WHERE UserId = '$userId' AND MusicId = '$musicId';";
      $response = mysqli_query($connection, $query)
        or die("Query Error!".mysqli_error($connection));
      
      if (mysqli_num_rows($response) > 0) {
        $item = mysqli_fetch_array($response);
        $tempQuantity = $item['Quantity'];
        $quantity += $tempQuantity;

        $query = "UPDATE Cart SET Quantity = $quantity WHERE MusicId = '$musicId' AND UserId = '$userId';";
        $response = mysqli_query($connection, $query)
          or die("Query Error!".mysqli_error($connection));
      }
      else {
        $query = "INSERT INTO Cart VALUES (NULL, '$musicId', '$userId', '$quantity');";
        $response = mysqli_query($connection, $query)
          or die("Query Error!".mysqli_error($connection));
      }
      
      $query = "SELECT * FROM Cart WHERE UserId = '$userId';";
      $response = mysqli_query($connection, $query)
        or die("Query Error!".mysqli_error($connection));

      $totalQuantity = 0;
      while ($item = mysqli_fetch_array($response)) {
        $totalQuantity += $item['Quantity'];
      }

      echo "done" . $totalQuantity;
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
      $musicExisted = false;
      foreach ($data as $key => $item) {
        if ($item[1] == $musicId) {
          $data[$key][3] += $quantity;
          $musicExisted = true;
          break;
        }
      }
      if (! $musicExisted) {
        array_push($data, array(0, $musicId, $userId, $quantity));
      }
      $_SESSION['GuestCart'] = serialize($data);
    }

    $totalQuantity = 0;
    foreach ($data as $key => $item) {
      $totalQuantity += $item[3];
    }

    echo "done" . $totalQuantity;
  }
  

