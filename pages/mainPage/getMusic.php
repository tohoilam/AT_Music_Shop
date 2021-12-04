<?php

  $connection = mysqli_connect('sophia.cs.hku.hk', 'hlto', 'Sph121Ng', 'hlto')
    or die("Connection Error! ".mysqli_connect_error());
  
  if ($_GET['type'] == 'nav') {
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

      echo "<div id='categoryHeading' class='pageHeadings'>Category</div>";
      foreach ($categories as $i => $category) {
        echo "<div class='categories pointer' onclick='changeCategory(this)'>" . $category . "</div>";
      }
    }
    else {
      echo "No Record";
    }
  }
  elseif ($_GET['type'] == 'all' || $_GET['type'] == 'category') {
    if ($_GET['type'] == 'all' ) {
      $query = "SELECT * FROM Music;";
      echo "<div id='category'>All Music</div>";
    }
    else {
      $byCategory = $_GET['category'];
      $query = "SELECT * FROM Music WHERE Category = '$byCategory';";
      echo "<div id='category'>All $byCategory</div>";
    }
    
    $response = mysqli_query($connection, $query)
      or die("Query Error!".mysqli_error($connection));
    
    if (mysqli_num_rows($response) > 0) {  
      while ($item = mysqli_fetch_array($response)) {
        $MusicId = $item['MusicId'];
        $MusicName = $item['MusicName'];
        $MusicImage = $item['MusicImage'];
        $Composer = $item['Composer'];
        $Price = $item['Price'];
        echo "<div id='$MusicId' class='musicRecord'>";
        echo "<div class='mainMusicName pointer floatLeft' onclick='goMusicInfo(this)'>$MusicName</div>";
        echo "<div class='mainMusicImageBox floatLeft'>";
        echo "<img src='media/$MusicImage' alt='$MusicName' title='$MusicName' />";
        echo "</div>";
        echo "<div class='mainMusicInfo floatLeft'>";
        if ($item['NewArrival'] == 1) {
          echo "<div class='mainMusicInfoItems floatLeft'>NEW ARRIVAL!</div>";
        }
        echo "<div class='mainMusicInfoItems floatLeft clearLeft mainComposerBox'>Composer: <span class='mainComposer'>$Composer</span></div>";
        echo "<div class='mainMusicInfoItems floatLeft clearLeft mainMusicPrice'>Price: $ $Price</div>";
        echo "</div>";
        echo "</div>";

      }
    }
    else {
      echo "No Record";
    }
  }
  

  
  

