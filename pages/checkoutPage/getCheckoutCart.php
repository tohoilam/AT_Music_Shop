<?php
  session_start();

  $connection = mysqli_connect('sophia.cs.hku.hk', 'hlto', 'Sph121Ng', 'hlto')
    or die("Connection Error! ".mysqli_connect_error());

  $totalPrice = 0;

  if (isset($_SESSION['UserId'])) {
    $UserId = $_SESSION['UserId'];
    
    $query = "SELECT C.CartId, C.MusicId, C.UserId, C.Quantity, M.MusicName, M.Price FROM Cart C, Music M WHERE C.MusicId = M.MusicId AND C.UserId = '$UserId';";
    $response = mysqli_query($connection, $query)
      or die("Query Error!".mysqli_error($connection));
    
    while ($row = mysqli_fetch_array($response)) {
      $Quantity = $row['Quantity'];
      $MusicName = $row['MusicName'];
      $Price = $row['Price'] * $Quantity;

      $totalPrice += $Price;

      echo "<div class='checkoutCartItems'>$Quantity x $MusicName &nbsp&nbsp&nbsp&nbsp HK$ $Price</div>";
    }
    
  }
  else {
    if ($_SESSION['GuestCart']) {
      $guestCart = unserialize($_SESSION['GuestCart']);

      foreach ($guestCart as $key => $musicItem) {
        $MusicId = $musicItem[1];
        $UserId = $musicItem[2];
        $Quantity = $musicItem[3];

        $query = "SELECT * FROM Music WHERE MusicId = '$MusicId'";
        $response = mysqli_query($connection, $query)
          or die("Query Error!".mysqli_error($connection));

        $row = mysqli_fetch_array($response);
        
        $MusicName = $row['MusicName'];
        $Price = $row['Price'] * $Quantity;
        $totalPrice += $Price;

        echo "<div class='checkoutCartItems'>$Quantity x $MusicName &nbsp&nbsp&nbsp&nbsp HK$ $Price</div>";
      }
    }
  }
  echo "<div id='checkoutTotalPrice'>Total Price: HK$ $totalPrice</div>";

  