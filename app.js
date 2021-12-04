let $topBar, $mainPage, $musicInfoPage, $cartPage, $loginPage, $createAccountPage, $checkoutPage, $invoicePage, $loading, $errorPage, $mainLinkPart;
let $homeLinks;

async function getUserId() {
  let response = await fetch('utilities/getUserId.php');
  try {
    if (response.status == 200) {
      let data = await response.text();
      if (data == "0") {
        return null;
      }
      else {
        return data;
      }
    }
    else {
      alert('HTTP return status:', response.status);
    }
  }
  catch (error) {
    alert('Fetch UserId from session Error');
  }
  
  // let xmlHttp = new XMLHttpRequest();
  // if (!xmlHttp) {
  //   alert('Cannot create XMLHttpRequest object!!');
  // }

  // xmlHttp.onreadystatechange = function() {

  //   if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
  //     let response = xmlHttp.responseText;
  //     console.log('Got response', response);
  //     if (response == "0") {
  //       return null;
  //     }
  //     else {
  //       return response
  //     }
  //   }
  // }
  // xmlHttp.open('POST', 'utilities/getUserId.php', true);
  // xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  // xmlHttp.send();
}

$(document).ready(function() {

  $topBar = $('#topBar');
  $mainPage = $('#mainPage');
  $musicInfoPage = $('#musicInfoPage');
  $cartPage = $('#cartPage');
  $loginPage = $('#loginPage');
  $createAccountPage = $('#createAccountPage');
  $checkoutPage = $('#checkoutPage');
  $invoicePage = $('#invoicePage');
  $homeLinks = $('.homeLink');
  $loading = $('#loading');
  $errorPage = $('#errorPage');
  $mainLinkPart = $('#mainLinkPart');
  // $globalSessionId = document.cookie.match(/PHPSESSID=[^;]+/);
  for (let i = 0; i < $homeLinks.length; i++) {
    $homeLinks[i].addEventListener('click', () => {
      changeTab('main', null);
    });
  }

  $('#addToCartSubmit').on('click', (event) => {
    addToCart($('#inputId').val(), $('#inputQuantity').val());
  })

  $('#signinButton').on('click', (event) => {
    changeTab('signin', null);
  })

  $('#registerButton').on('click', (event) => {
    changeTab('register', null);
  })

  $('#cartButton').on('click', (event) => {
    changeTab('cart', null);
    cartInitialize();
  })

  $('#cartPageBackButton').on('click', (event) => {
    changeTab('main', null);
  })

  $('#checkOutButton').on('click', (event) => {
    changeTab('checkout', null);
  })

  $('#LoginForm').submit(function(event) {
    loginFormSubmit();
    return false;
  })

  $('#RegisterForm').submit(function(event) {
    registerFormSubmit();
    return false;
  })

  $('#createAccountFromLogin').on('click', (event) => {
    changeTab('register', null);
  })

  $('#loginFromCreateAccount').on('click', (event) => {
    changeTab('signin', null);
  })

  $('#checkoutToSignin').on('click', (event) => {
    changeTab('signin', null);
  })

  $('#checkoutBackCartButton').on('click', (event) => {
    changeTab('cart', null);
    cartInitialize();
  })

  $('#checkoutConfirmButton').on('click', (event) => {
    confirmCheckout();
  })

  $('#searchButton').on('click', async (event) => {
    await changeTab('main', null, false);
    let stringInput = $('#searchInput').val();
    let inputList = stringInput.split(' ');
    
    $('#musicRecordsArea > div').each(function() {
      let $musicBox = $(this);
      $musicBox.hide();
      
      $('#mainPageHeading').text('Searching Results');

      let musicName = $musicBox.children('.mainMusicName').text();
      let composer = $musicBox.children('.mainMusicInfo').children('.mainComposerBox').children('.mainComposer').text();
      
      for (let i = 0; i < inputList.length; i++) {
        if (musicName.includes(inputList[i]) || composer.includes(inputList[i])) {
          $musicBox.show();
          break;
        }
      }
    })
    
  })

  $('#registerButton').hide();
  $('#signinButton').hide();
  $('#logoutButton').hide();
  $('#cartButton').hide();

  changeTab('main', null);
})

async function changeTab(tabType, param, toLoad = true) {
  if (toLoad) {
    $mainPage.hide();
    $musicInfoPage.hide();
    $cartPage.hide();
    $loginPage.hide();
    $createAccountPage.hide();
    $checkoutPage.hide();
    $invoicePage.hide();
    $errorPage.hide();
    // $topBar.hide();
    $loading.show();
  }
  

  let userId = await getUserId();

  await changeCartTotal();

  $loading.hide();

  if (tabType === 'main') {
    await getMusicRecords();
    $mainPage.show();
    $musicInfoPage.hide();
    $cartPage.hide();
    $loginPage.hide();
    $createAccountPage.hide();
    $checkoutPage.hide();
    $invoicePage.hide();
    $errorPage.hide();
    $topBar.show();
    $mainLinkPart.hide();
    
    if (userId) {
      $('#registerButton').hide();
      $('#signinButton').hide();
      $('#logoutButton').show();
      $('#cartButton').show();
    }
    else {
      $('#registerButton').show();
      $('#signinButton').show();
      $('#logoutButton').hide();
      $('#cartButton').show();
    }
    
  }
  else if(tabType === 'musicInfo') {
    $loading.show();
    await setMusicInfo(param);
    $mainPage.hide();
    $musicInfoPage.show();
    $errorPage.hide();
    $loading.hide();
    $topBar.show();
  }
  else if (tabType === 'signin') {
    $mainPage.hide();
    $musicInfoPage.hide();
    $cartPage.hide();
    $loginPage.show();
    $createAccountPage.hide();
    $checkoutPage.hide();
    $invoicePage.hide();
    $errorPage.hide();
    $topBar.show();
    $('#loginUsername').text('');
    $('#loginPassword').text('');
  }
  else if (tabType === 'register') {
    $mainPage.hide();
    $musicInfoPage.hide();
    $cartPage.hide();
    $loginPage.hide();
    $createAccountPage.show();
    $checkoutPage.hide();
    $invoicePage.hide();
    $errorPage.hide();
    $topBar.show();
    $('#loginUsername').text('');
    $('#loginPassword').text('');
  }
  else if (tabType === 'errorPage') {
    $mainPage.hide();
    $musicInfoPage.hide();
    $cartPage.hide();
    $loginPage.hide();
    $createAccountPage.hide();
    $checkoutPage.hide();
    $invoicePage.hide();
    $errorPage.show();
    $topBar.hide();
  }
  else if (tabType === 'cart') {
    $mainPage.hide();
    $musicInfoPage.hide();
    $cartPage.show();
    $loginPage.hide();
    $createAccountPage.hide();
    $checkoutPage.hide();
    $invoicePage.hide();
    $errorPage.hide();
    $topBar.show();
  }
  else if (tabType === 'checkout') {
    initializeCheckoutPage();

    $mainPage.hide();
    $musicInfoPage.hide();
    $cartPage.hide();
    $loginPage.hide();
    $createAccountPage.hide();
    $checkoutPage.show();
    $invoicePage.hide();
    $errorPage.hide();
    $topBar.hide();
  }
}

async function changeCartTotal() {
  try {
    let response = await fetch('utilities/getCartTotal.php');
    if (response.status == 200) {
      let data = await response.text();
      if (data.substring(0, 4) === 'done') {
        let totalQuantity = data.substring(4);
        $('#cartButton').text(`Cart (${totalQuantity})`)
      }
      else {
        alert('Failed changing cart total!');
      }
    }
    else {
      alert('HTTP return status:', response.status);
    }
  }
  catch (error) {
    alert('Fetch cart total resulted in an error!');
  }
}

// $(window).bind('beforeunload', function(event) {
//   return 'Items in cart will disappear';
  
// })