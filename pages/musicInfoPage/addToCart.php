<?php

  $connection = mysqli_connect('sophia.cs.hku.hk', 'hlto', 'Sph121Ng', 'hlto')
    or die("Connection Error! ".mysqli_connect_error());
  
  $musicId = $_POST['musicId'];
  $quantity = $_POST['quantity'];
  $userId = $_POST['userId'];

  $query = "INSERT INTO Cart VALUES (NULL, '$musicId', '$userId', '$quantity');";
  $response = mysqli_query($connection, $query)
    or die("Query Error!".mysqli_error($connection));

  echo "done";

?>