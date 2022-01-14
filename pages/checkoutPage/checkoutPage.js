
function initializeCheckoutPage() {
  toggleSection1();
  getCheckoutCart();
}

async function getCheckoutCart() {

  try {
    let response = await fetch('pages/checkoutPage/getCheckoutCart.php');
    if (response.status == 200) {
      let data = await response.text();
      $('#orderArea').html(data);
    }
    else {
      alert('HTTP return status:', response.status);
    }
  }
  catch (error) {
    alert('Fetch checkout cart resulted in an Error!');
  }

  // try {
  //   let response = await fetch('pages/checkoutPage/getCheckoutCart.php');
  //   if (response.status == 200) {
  //     let data = await response.text();

  //   }
  //   else {
  //     alert('HTTP return status:', response.status);
  //   }
  // }
  // catch (error) {
  //   alert('Fetch checkout cart resulted in an Error!');
  // }
}

async function obtainUserId() {
  try {
    let response = await fetch('utilities/getUserId.php');
    if (response.status == 200) {
      let data = await response.text();
      return data;
    }
    else {
      alert('HTTP return status:', response.status);
    }
  }
  catch (error) {
    alert('Fetch checkout cart resulted in an Error!');
  }
}

async function toggleSection1() {
  let data = await obtainUserId();
  if (data && data != 0) {
    $('#section1').hide();
  }
  else {
    $('#section1').show();
  }
}

async function confirmCheckout() {
  let userId = await obtainUserId();
  let valid = true;
  
  $('.validation[data-error] input').each(function() {
    if (userId && userId != 0) {
      if (this.id == 'checkoutRegisterUsername' || this.id == 'checkoutRegisterPassword') {
        return;
      }
    }

    if (!this.validity.valid) {
      valid = false;
    }
  })

  if (valid) {
    checkout();
  }
}

async function checkout() {
  let userId = await obtainUserId();
  let username;
  let success = true;

  if (! (userId && userId != 0)) {
    username = $('#checkoutRegisterUsername').val();
    let password = $('#checkoutRegisterPassword').val();

    success = false;

    try {
      let response = await fetch(`pages/registerPage/verifyRegister.php?username=${username}&password=${password}`);
      if (response.status == 200) {
        let data = await response.text();

        if (data == 'done') {
          success = true;
        }
        else if (data == 'user_exists') {
          alert("User Exists, please change a username");
          return;
        }
      }
      else {
        alert('HTTP return status:', response.status);
      }
    }
    catch (error) {
      alert('Create account in checkout resulted in an Error!');
    }
  }
  else {
    username = userId;
  }

  if (success) {
    let fullName = $('#fullName').val();
    let companyName = $('#companyName').val();
    if (!companyName) {
      companyName = 'NA';
    }
    let addressLine1 = $('#addressLine1').val();
    let addressLine2 = $('#addressLine2').val();
    if (!addressLine2) {
      addressLine2 = 'NA';
    }
    let city = $('#city').val();
    let region = $('#region').val();
    if (!region) {
      region = 'NA';
    }
    let country = $('#country').val();
    let zipCode = $('#zipCode').val();

    $('#invoiceFullName > .devlieryValue').text(fullName);
    $('#invoiceCompany > .devlieryValue').text(companyName);
    $('#invoiceAddressLine1 > .devlieryValue').text(addressLine1);
    $('#invoiceAddressLine2 > .devlieryValue').text(addressLine2);
    $('#invoiceCity > .devlieryValue').text(city);
    $('#invoiceRegion > .devlieryValue').text(region);
    $('#invoiceCountry > .devlieryValue').text(country);
    $('#invoiceZipCode > .devlieryValue').text(zipCode);

    await getDeliveryInfoForInvoice();

    changeTab('invoicePage', null);

  }
}

async function checkIsNewUser(username) {
  try {
    let response = await fetch(`pages/checkoutPage/checkUserExist.php?username=${username}`);
    if (response.status == 200) {
      let data = await response.text();
      if (data == 'ok') {
        return true;
      }
      else {
        return false
      }
    }
    else {
      alert('HTTP return status:', response.status);
    }
  }
  catch (error) {
    alert('Fetch checkout cart resulted in an Error!');
  }
}
