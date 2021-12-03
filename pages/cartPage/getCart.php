<?php
  session_start();

  $connection = mysqli_connect('sophia.cs.hku.hk', 'hlto', 'Sph121Ng', 'hlto')
    or die("Connection Error! ".mysqli_connect_error());
  
  $totalPrice = 0;

  if (isset($_SESSION['UserId'])) {
    $username = $_SESSION['UserId'];

    echo "$username";

    $query = "SELECT C.CartId, C.MusicId, C.UserId, C.Quantity, M.MusicName, M.Price FROM Cart C, Music M WHERE C.MusicId = M.MusicId AND C.UserId = '$username';";
    $response = mysqli_query($connection, $query)
      or die("Query Error!".mysqli_error($connection));

    while ($row = mysqli_fetch_array($response)) {
      $CartId = $row['CartId'];
      $MusicId = $row['MusicId'];
      $UserId = $row['UserId'];
      $Quantity = $row['Quantity'];
      $MusicName = $row['MusicName'];
      $Price = $row['Price'];
      $totalPrice += $Price;
      echo "<div id='$CartId' class='cartItem'>";
      echo "<div>Music Name: $MusicName</div>";
      echo "<div>Quantity: $Quantity</div>";
      echo "</div>";
    }

    
  }
  else {
    if ($_SESSION['GuestCart']) {
      $guestCart = unserialize($_SESSION['GuestCart']);
      for ($i = 0; $i < sizeof($guestCart); $i++) {
        $MusicId = $guestCart[$i][1];
        $UserId = $guestCart[$i][2];
        $Quantity = $guestCart[$i][3];

        $query = "SELECT * FROM Music WHERE MusicId = '$MusicId'";
        $response = mysqli_query($connection, $query)
          or die("Query Error!".mysqli_error($connection));

        $row = mysqli_fetch_array($response);
        
        $MusicName = $row['MusicName'];
        $Price = $row['Price'];
        $totalPrice += $Price;
        echo "<div class='cartItem'>";
        echo "<div>Music Name: $MusicName</div>";
        echo "<div>Quantity: $Quantity</div>";
        echo "</div>";
      }
    }
  }
  echo "<div>Total Price: $ $totalPrice</div>";
  

