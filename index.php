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
  <script src="pages/checkoutPage/checkoutPage.js"></script>
  <link rel="stylesheet" href="app.css">
  <link rel="stylesheet" href="pages/mainPage/mainPage.css">
  <link rel="stylesheet" href="pages/musicInfoPage/musicInfoPage.css">
  <link rel="stylesheet" href="pages/cartPage/cartPage.css">
  <link rel="stylesheet" href="pages/checkoutPage/checkoutPage.css">
  <link rel="stylesheet" href="pages/invoicePage/invoicePage.css">

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
      <div id='cartPageBackButton' class='buttons floatLeft'>Back</div>
      <div id='checkOutButton' class='buttons floatLeft'>Checkout</div>
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
      <div id="section1">
        <div id='section1Info'>
          <div id="newCustomer" class="sectionOneItem floatLeft">
            <div class="checkoutPageHeadings">I'm a new customer</div>
            <div class="iamAction">Please Checkout Below</div>
          </div>
          <div class="or floatLeft">or</div>
          <div id="existingCustomer" class="sectionOneItem floatLeft">
            <div class="checkoutPageHeadings">I'm already a customer</div>
            <div id='checkoutToSignin' class="iamAction buttons"> Sign In</div>
          </div>
        </div>
        <div id='checkoutCreateAccount'>
          <div class='checkoutPageHeadings'>Create Account:</div>
          <div class='checkoutFormItem'>
            <div class='validation' data-error>
              <label for='username'>Username</label>
              <input type='text' id='checkoutRegisterUsername' name='username' placeholder='Desired Username' maxlength='8' pattern='[0-9]{8}' required>
            </div>
          </div>
          <div class='checkoutFormItem'>
            <div class='validation' data-error>
              <label for='password'>Password</label>
              <input type='password' id='checkoutRegisterPassword' name='password' placeholder='Desired Password' maxlength='12' pattern='.{8,12}' required>
            </div>
          </div>
        </div>
      </div>
      <div id="section2">
        <div id="deliveryAddressHeading" class='checkoutPageHeadings'>Delivery Address:</div>
        <div class='checkoutFormItem'>
          <div class='validation' data-error>
            <label for='fullName'>Full Name</label>
            <input type='text' id='fullName' name='fullName' placeholder='Required' required>
          </div>
        </div>
        <div class='checkoutFormItem'>
          <label for='companyName'>Company Name</label>
          <input type='text' id='companyName' name='companyName'>
        </div>
        <div class='checkoutFormItem'>
          <div class='validation' data-error>
            <label for='addressLine1'>Address Line 1</label>
            <input type='text' id='addressLine1' name='addressLine1' placeholder='Required' required>
          </div>
        </div>
        <div class='checkoutFormItem'>
          <label for='addressLine2'>Address Line 2</label>
          <input type='text' id='addressLine2' name='addressLine2'>
        </div>
        <div class='checkoutFormItem'>
          <div class='validation' data-error>
            <label for='city'>City</label>
            <input type='text' id='city' name='city' placeholder='Required' required>
          </div>
        </div>
        <div class='checkoutFormItem'>
          <label for='region'>Region/State/District</label>
          <input type='text' id='region' name='region'>
        </div>
        <div class='checkoutFormItem'>
          <div class='validation' data-error>
            <label for='country'>Country</label>
            <input type='text' id='country' name='country' placeholder='Required' required>
          </div>
        </div>
        <div class='checkoutFormItem'>
          <div class='validation' data-error>
            <label for='zipCode'>Postcode/Zip Code</label>
            <input type='text' id='zipCode' name='zipCode' placeholder='Required' required>
          </div>
        </div>
      </div>
      <div id="section3">
        <div id='yourOrderInfoSection'>
          <div id="yourOrderHeading" class='checkoutPageHeadings floatLeft'>Your order</div>
          <div id='checkoutBackCartButton' class='buttons floatLeft'>change</div>
          <div id='shipping' class='floatLeft clearLeft'>Free Standard Shipping</div>
        </div>
        <div id='orderArea'></div>
      </div>
      <div id='checkoutConfirmButton' class='buttons'>Confirm</div>
    </div>
    <div id="invoicePage">
      <div id="invoiceHeading" class='checkoutPageHeadings'>Invoice Page</div>
      <div id="deliveryInfoArea">
        <div class='deliveryLine'>
          <div id='invoiceFullName' class='deliveryInfo'>
            <div class='deliveryLabel'>Full Name:</div>
            <div class='devlieryValue'></div>
          </div>
          <div id='invoiceCompany' class='deliveryInfo'>
            <div class='deliveryLabel'>Company:</div>
            <div class='devlieryValue'></div>
          </div>
        </div>
        <div class='deliveryLine'>
          <div id='invoiceAddressLine1' class='deliveryInfo'>
            <div class='deliveryLabel'>Address Line 1:</div>
            <div class='devlieryValue'></div>
          </div>
        </div>
        <div class='deliveryLine'>
          <div id='invoiceAddressLine2' class='deliveryInfo'>
            <div class='deliveryLabel'>Address Line 2:</div>
            <div class='devlieryValue'></div>
          </div>
        </div>
        <div class='deliveryLine'>
          <div id='invoiceCity' class='deliveryInfo'>
            <div class='deliveryLabel'>City:</div>
            <div class='devlieryValue'></div>
          </div>
          <div id='invoiceRegion' class='deliveryInfo'>
            <div class='deliveryLabel'>Region:</div>
            <div class='devlieryValue'></div>
          </div>
          <div id='invoiceCountry' class='deliveryInfo'>
            <div class='deliveryLabel'>Country:</div>
            <div class='devlieryValue'></div>
          </div>
        </div>
        <div class='deliveryLine'>
          <div id='invoiceZipCode' class='deliveryInfo'>
            <div class='deliveryLabel'>Postcode:</div>
            <div class='devlieryValue'></div>
          </div>
        </div>
      </div>
    </div>
    <div id="loading">
      Loading...
    </div>
  </main>
</body>
</html>