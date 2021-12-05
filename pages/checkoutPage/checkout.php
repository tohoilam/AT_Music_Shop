<?php
  session_start();

  $username = $_GET['username'];
  $fullName = $_GET['fullName'];
  $companyName = $_GET['companyName'];
  $addressLine1 = $_GET['addressLine1'];
  $addressLine2 = $_GET['addressLine2'];
  $city = $_GET['city'];
  $region = $_GET['region'];
  $country = $_GET['country'];
  $zipCode = $_GET['zipCode'];

  $_SESSION['fullName'] = $fullName;
  $_SESSION['companyName'] = $companyName;
  $_SESSION['addressLine1'] = $addressLine1;
  $_SESSION['addressLine2'] = $addressLine2;
  $_SESSION['city'] = $city;
  $_SESSION['region'] = $region;
  $_SESSION['country'] = $country;
  $_SESSION['zipCode'] = $zipCode;

  echo "done";