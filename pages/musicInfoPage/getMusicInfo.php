<?php
  $connection = mysqli_connect('sophia.cs.hku.hk', 'hlto', 'Sph121Ng', 'hlto')
    or die("Connection Error! ".mysqli_connect_error());
  
  $musicId = $_POST['musicId'];
  
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
      // echo "<div id=''>"
      echo "<div id='infoMusicId' class='displayNone'>$MusicId</div>";
      echo "<div id='infoMusicName'>$MusicName</div>";
      echo "<div>$MusicImage</div>";
      echo "<div>$MusicClip</div>";
      
      echo "<div>$Composer</div>";
      echo "<div>$Published</div>";
      echo "<div>$Category</div>";
      echo "<div>$Description</div>";
      echo "<div>$Price</div>";
      
      
    }
  }
  else {
    echo "No Record";
  }

