let $topBar, $mainPage, $musicInfoPage, $cartPage, $loginPage, $createAccountPage, $checkoutPage, $invoicePage, $loading, $errorPage;
let $homeLinks;

async function getUserId() {
  let response = await fetch('utilities/getUserId.php');
  try {
    if (response.status == 200) {
      let data = await response.text();
      console.log(data);
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

  $('#searchButton').on('click', async (event) => {
    await changeTab('main', null);
    let stringInput = $('#searchInput').val();
    let inputList = stringInput.split(' ');
    
    $('#musicRecordsArea > div').each(function() {
      let $musicBox = $(this);
      $musicBox.hide();

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

  changeTab('main', null);
})

async function changeTab(tabType, param) {
  // $mainPage.hide();
  // $musicInfoPage.hide();
  // $cartPage.hide();
  // $loginPage.hide();
  // $createAccountPage.hide();
  // $checkoutPage.hide();
  // $invoicePage.hide();
  // $errorPage.hide();
  // // $topBar.hide();
  // $loading.show();

  let userId = await getUserId();

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
    
    if (userId) {
      $('#registerButton').hide();
      $('#signinButton').hide();
      $('#logoutButton').show();
    }
    else {
      $('#registerButton').show();
      $('#signinButton').show();
      $('#logoutButton').hide();
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
    $topBar.hide();
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
    $topBar.hide();
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
}

// $(window).bind('beforeunload', function(event) {
//   return 'Items in cart will disappear';
  
// })