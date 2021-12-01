<?php

  $connection = mysqli_connect('sophia.cs.hku.hk', 'hlto', 'Sph121Ng', 'hlto')
    or die("Connection Error! ".mysqli_connect_error());
  
  $query = "SELECT * FROM Music;";
  $response = mysqli_query($connection, $query)
    or die("Query Error!".mysqli_error($connection));
  
  if (mysqli_num_rows($response) > 0) {  
    if ($_POST['type'] == 'nav') {
      $categories = array();

      while ($item = mysqli_fetch_array($response)) {
        if (! in_array($item["Category"], $categories)) {
          $categories[] = $item["Category"];
        }
      }
      sort($categories);

      foreach ($categories as $i => $category) {
        echo "<div>" . $category . "</div>";
      }
    }
    elseif ($_POST['type'] == 'all') {
      while ($item = mysqli_fetch_array($response)) {
        $MusicId = $item['MusicId'];
        echo "<div id='$MusicId' class='musicRecord' onclick='goMusicInfo(this)'>";
        echo $item['MusicName'];
        echo $item['MusicImage'];
        if ($item['NewArrival'] == 1) {
          echo "NEW ARRIVAL!";
        }
        echo 'Composer: ' . $item['Composer'];
        echo 'Price: $ ' . $item['Price'];
        echo "</div>";

      }
    }
    
  }
  else {
    echo "No Record";
  }
  

  
  

?>