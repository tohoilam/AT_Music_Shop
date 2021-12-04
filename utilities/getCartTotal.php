<?php
  session_start();

  if (isset($_SESSION['UserId'])) {
    $userId = $_SESSION['UserId'];

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
    $totalQuantity = 0;

    if (isset($_SESSION['GuestCart'])) {
      $data = unserialize($_SESSION['GuestCart']);
      foreach ($data as $key => $item) {
        $totalQuantity += $item[3];
      }
    }

    echo "done" . $totalQuantity;
  }