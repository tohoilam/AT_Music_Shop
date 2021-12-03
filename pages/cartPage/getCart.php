
<?php
  $_SESSION['now'] = 'now';

  $connection = mysqli_connect('sophia.cs.hku.hk', 'hlto', 'Sph121Ng', 'hlto')
    or die("Connection Error! ".mysqli_connect_error());

  
  $username = $_SESSION['UserId'];

  $query = "SELECT C.CartId, C.MusicId, C.UserId, C.Quantity, M.MusicName, M.Price FROM Cart C, Music M WHERE C.MusicId = M.MusicId AND C.UserId = '$username';";
  $response = mysqli_query($connection, $query)
    or die("Query Error!".mysqli_error($connection));
  
  $totalPrice = 0;
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

  echo "<div>Total Price: $ $totalPrice</div>";
  
  

