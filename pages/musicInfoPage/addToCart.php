<?php
  session_start();

  $connection = mysqli_connect('sophia.cs.hku.hk', 'hlto', 'Sph121Ng', 'hlto')
    or die("Connection Error! ".mysqli_connect_error());
  
  $musicId = $_POST['musicId'];
  $quantity = $_POST['quantity'];

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
  

