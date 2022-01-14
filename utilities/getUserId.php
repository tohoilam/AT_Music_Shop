<?php

  session_start();
  if (isset($_SESSION['UserId'])) {
    $UserId = $_SESSION['UserId'];
    echo "$UserId";
  }
  else {
    echo "0";
  }