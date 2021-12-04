<?php

  $connection = mysqli_connect('sophia.cs.hku.hk', 'hlto', 'Sph121Ng', 'hlto')
    or die("Connection Error! ".mysqli_connect_error());
  
  if ($_POST['type'] == 'nav') {
    $query = "SELECT * FROM Music;";
    $response = mysqli_query($connection, $query)
      or die("Query Error!".mysqli_error($connection));
    
    if (mysqli_num_rows($response) > 0) {  
      $categories = array();

      while ($item = mysqli_fetch_array($response)) {
        if (! in_array($item["Category"], $categories)) {
          $categories[] = $item["Category"];
        }
      }
      sort($categories);

      echo "<div id='categoryHeading'>Category</div>";
      foreach ($categories as $i => $category) {
        echo "<div class='categories pointer' onclick='changeCategory(this)'>" . $category . "</div>";
      }
    }
    else {
      echo "No Record";
    }
  }
  elseif ($_POST['type'] == 'all' || $_POST['type'] == 'category') {
    if ($_POST['type'] == 'all' ) {
      $query = "SELECT * FROM Music;";
    }
    else {
      $byCategory = $_POST['category'];
      $query = "SELECT * FROM Music WHERE Category = '$byCategory';";
    }
    
    $response = mysqli_query($connection, $query)
      or die("Query Error!".mysqli_error($connection));
    
    if (mysqli_num_rows($response) > 0) {  
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
    else {
      echo "No Record";
    }
  }
  

  
  

