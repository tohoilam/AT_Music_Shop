
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

  if (!(userId && userId != 0)) {
    // if (document.querySelector('#fullName').validity.valueMissing) {
    //   console.log('empty');
    // }
  }
}