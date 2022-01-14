<?php
  $connection = mysqli_connect('sophia.cs.hku.hk', 'hlto', 'Sph121Ng', 'hlto')
    or die("Connection Error! ".mysqli_connect_error());
  
  $musicId = $_GET['musicId'];
  
  $query = "SELECT * FROM Music WHERE MusicId=$musicId;";
  $response = mysqli_query($connection, $query)
    or die("Query Error!".mysqli_error($connection));
  
  if (mysqli_num_rows($response) > 0) {
    while ($item = mysqli_fetch_array($response)) {
      $MusicId = $item['MusicId'];
      $MusicName = $item['MusicName'];
      $Category = $item['Category'];
      $Composer = $item['Composer'];
      $Description = $item['Description'];
      $Price = $item['Price'];
      $Published = $item['Published'];
      $NewArrival = $item['NewArrival'];
      $MusicImage = $item['MusicImage'];
      $MusicClip = $item['MusicClip'];
      
      echo "<div id='infoMusicId' class='displayNone'>$MusicId</div>";
      echo "<div id='infoMusicName'>$MusicName</div>";
      echo "<div id='infoMusicImageBox'>";
      echo "<img src='media/$MusicImage' alt='$MusicName' title='$MusicName' />";
      echo "</div>";

      echo "<audio autoplay controls>";
      echo "<source src='media/$MusicClip' type='audio/mp3'>";
      echo "</audio>";
      
      echo "<div id='infoMusicInfo'>";
      echo "<div class='infoMusicInfoItems'>Composer: $Composer</div>";
      echo "<div class='infoMusicInfoItems'>Published: $Published</div>";
      echo "<div class='infoMusicInfoItems'>Category: $Category</div>";
      echo "<div class='infoMusicInfoItems'>Description: $Description</div>";
      echo "<div id='infoPrice' class='infoMusicInfoItems'>Price: $ $Price</div>";
      echo "</div>";
      
      
    }
  }
  else {
    echo "No Record";
  }

