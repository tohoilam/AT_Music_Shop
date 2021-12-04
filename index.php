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
  <link rel="stylesheet" href="pages/musicInfoPage/musicInfoPage.css">
  <link rel="stylesheet" href="pages/cartPage/cartPage.css">

  <title>COMP3322_Project</title>
</head>
<body>
  <header>COMP3322 Project</header>
  <main>
    <div id="topBar">
      <div id='searchBar'>
        <input type='text' id='searchInput' class='floatLeft' name='searchBar' placeholder='Keyword(s)'>
        <div id='searchButton' class='buttons pointer floatLeft'>Search</div>
      </div>
      <div id='buttonsMenu'>
        <div id='cartButton' class='buttons floatRight'>Cart (0)</div>
        <div id='registerButton' class='buttons floatRight'>Register</div>
        <div id='signinButton' class='buttons floatRight'>Sign in</div>
        <div id='logoutButton' class='buttons floatRight'><a href='utilities/logout.php'>Logout</a></div>
      </div>
    </div>
    <div id="mainPage">
      <nav class="floatLeft"></nav>
      <div id="mainSection" class="floatLeft">
        <div id="mainPageHeadingBar" class="pageHeader">
          <div class="directoryLink">
            <span class="homeLink link pointer">Home</span> <span id="mainLinkPart">&nbsp> &nbsp<span class="subLink link pointer"></span></span>
          </div>
          <div id='mainPageHeading' class='pageHeadings'>
            All Music
          </div>
        </div>
      
        <div id="musicRecordsArea"></div>
      </div>
    </div>
    <div id="musicInfoPage">
      <div id="musicInfoPageHeading" class="pageHeader">
        <div class="directoryLink">
          <span class="homeLink link pointer">Home</span> <span id="musicInfoLinkPart">&nbsp> &nbsp<span class="subLink link pointer"></span></span>
        </div>
        <div id='musicInfoPageHeading' class='pageHeadings'>
          Music Info
        </div>
      </div>
      <div id="musicInfoPageArea">
        <div id="musicInformation"></div>
        <div id='addToCard' onsubmit="addToCart()">
          <div id='orderText' class='floatLeft'>Order:&nbsp </div>
          <input id='inputQuantity' class='floatLeft' type='text' name='quantity' value='1' pattern='[1-9]|[1-9][0-9]|[1-9][0-9][0-9]' required>
          <input id='inputId' type="hidden" name='id' value='1'>
          <div id='addToCartSubmit' class='buttons floatLeft'>Add to Cart</div>
        </div>
      </div>
    </div>
    <div id="cartPage">
      <div id='cartPageHeading' class='pageHeadings'>My Shopping Cart</div>
      <div id="cartArea"></div>
    </div>
    <div id="loginPage">
      Login Page
      <form id='LoginForm'>
        <label for='username'>Username</label>
        <input type='text' id='loginUsername' name='username' placeholder='Username' maxlength='8' pattern='[0-9]{8}' required oninvalid="this.setCustomValidity('User ID must be 8 digits number!')" onchange="this.setCustomValidity('')">
        <label for='password'>Password</label>
        <input type='password' id='loginPassword' name='password' placeholder='Password' maxlength='12' pattern='.{8,12}' required oninvalid="this.setCustomValidity('Password must be 8-12 characters long')" onchange="this.setCustomValidity('')">
        <input id='loginFormButton' class='buttons' type='submit' value='SUBMIT'>
        <div id='createAccountFromLogin' class='buttons'>CREATE</div>
      </form>
    </div>
    <div id='errorPage'><h1></h1></div>
    <div id="createAccountPage">
      Create Account Page
      <form id='RegisterForm'>
        <label for='username'>Desired Username</label>
        <input type='text' id='registerUsername' name='username' placeholder='Desired Username' maxlength='8' pattern='[0-9]{8}' required oninvalid="this.setCustomValidity('User ID must be 8 digits number!')" onchange="this.setCustomValidity('')">
        <label for='password'>Desierd Password</label>
        <input type='password' id='registerPassword' name='password' placeholder='Desired Password' maxlength='12' pattern='.{8,12}' required oninvalid="this.setCustomValidity('Password must be 8-12 characters long')" onchange="this.setCustomValidity('')">
        <input id='registerFormButton' class='buttons' type='submit' value='CONFIRM'>
        <div id='loginFromCreateAccount' class='buttons'>BACK</div>
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