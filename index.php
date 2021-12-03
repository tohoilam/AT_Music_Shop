<?php
  

  session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="app.js"></script>
  <script src="pages/mainPage/mainPage.js"></script>
  <script src="pages/musicInfoPage/musicInfoPage.js"></script>
  <script src="pages/loginPage/loginPage.js"></script>
  <script src="pages/registerPage/registerPage.js"></script>
  <script src="pages/cartPage/cartPage.js"></script>
  <link rel="stylesheet" href="app.css">
  <link rel="stylesheet" href="pages/mainPage/mainPage.css">

  <title>COMP3322_Project</title>
</head>
<body>
  <header>COMP3322 Project</header>
  <main>
    <div id="topBar"></div>
    <div id="mainPage">
      <nav class="floatLeft"></nav>
      <div id="mainPageHeading" class="pageTab">
        <div class="directoryLink floatLeft">
          <span class="homeLink pointer">Home</span> > <span class="subLink pointer"></span>
        </div>
        <div id='buttonsMenu floatRight'>
          <div id='cartButton' class='buttons floatRight'>Cart</div>
          <div id='registerButton' class='buttons floatRight'>Register</div>
          <div id='signinButton' class='buttons floatRight'>Sign in</div>
          <div id='logoutButton' class='buttons floatRight'><a href='utilities/logout.php'>Logout</a></div>
        </div>
      </div>
      <div id="musicRecordsArea"></div>
      <?php 
        $testing = $_SESSION['testing'];
        echo "yay";
        echo "$testing";
      ?>
    </div>
    <div id="musicInfoPage">
      <div id="musicInfoPageHeading" class="pageTab">
        <div class="directoryLink">
          <span class="homeLink pointer">Home</span> > <span class="subLink pointer"></span>
        </div>
        Music Info Page
      </div>
      <div id="musicInfoPageArea">
        <div id="musicInformation"></div>
        <div id='addToCard' onsubmit="addToCart()">
          Order: <input id='inputQuantity' type='text' name='quantity' value='1' pattern='[1-9]|[1-9][0-9]|[1-9][0-9][0-9]' required>
          <input id='inputId' type="hidden" name='id' value='1'>
          <div id='addToCartSubmit' class='buttons'>Submit</div>
        </div>
      </div>
    </div>
    <div id="cartPage">
      My Shopping Cart
      <div id="cartArea"></div>
    </div>
    <div id="loginPage">
      Login Page
      <form id='LoginForm'>
        <label for='username'>Username</label>
        <input type='text' id='loginUsername' name='username' maxlength='8' pattern='[0-9]{8}' required oninvalid="this.setCustomValidity('User ID must be 8 digits number!')" onchange="this.setCustomValidity('')">
        <label for='password'>Password</label>
        <input type='text' id='loginPassword' name='password' maxlength='12' pattern='.{8,12}' required oninvalid="this.setCustomValidity('Password must be 8-12 characters long')" onchange="this.setCustomValidity('')">
        <input id='loginFormButton' class='buttons' type='submit' value='Submit'>
        <div id="loginError"></div>
      </form>
    </div>
    <div id="createAccountPage">
      Create Account Page
      <form id='RegisterForm'>
        <label for='username'>Desired Username</label>
        <input type='text' id='registerUsername' name='username' maxlength='8' pattern='[0-9]{8}' required oninvalid="this.setCustomValidity('User ID must be 8 digits number!')" onchange="this.setCustomValidity('')">
        <label for='password'>Desierd Password</label>
        <input type='text' id='registerPassword' name='password' maxlength='12' pattern='.{8,12}' required oninvalid="this.setCustomValidity('Password must be 8-12 characters long')" onchange="this.setCustomValidity('')">
        <input id='registerFormButton' type='submit' value='Submit'>
        <div id="registerError"></div>
      </form>
    </div>
    <div id="checkoutPage">
      Check Out Page
    </div>
    <div id="invoicePage">
      Invoice Page
    </div>
    <div id="loading">
      Loading...
    </div>
  </main>
</body>
</html>