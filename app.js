let $topBar, $mainPage, $musicInfoPage, $cartPage, $loginPage, $createAccountPage, $checkoutPage, $invoicePage;
let $homeLinks;
let globalUserId = 0;
let globalSessionId = 0;

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
  $globalSessionId = document.cookie.match(/PHPSESSID=[^;]+/);
  for (let i = 0; i < $homeLinks.length; i++) {
    $homeLinks[i].addEventListener('click', () => {
      changeTab('main', null)
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

  $mainPage.show();
  $musicInfoPage.hide();
  $cartPage.hide();
  $loginPage.hide();
  $createAccountPage.hide();
  $checkoutPage.hide();
  $invoicePage.hide();
})

function changeTab(tabType, param) {
  if (tabType === 'main') {
    $mainPage.show();
    $musicInfoPage.hide();
    $cartPage.hide();
    $loginPage.hide();
    $createAccountPage.hide();
    $checkoutPage.hide();
    $invoicePage.hide();
  }
  else if(tabType === 'musicInfo') {
    // param = music id
    $mainPage.hide();
    $musicInfoPage.show();
    setMusicInfo(param);
  }
  else if (tabType === 'signin') {
    $mainPage.hide();
    $musicInfoPage.hide();
    $cartPage.hide();
    $loginPage.show();
    $createAccountPage.hide();
    $checkoutPage.hide();
    $invoicePage.hide();
    $('#loginError').text('');
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
  }
  else if (tabType === 'cart') {
    $mainPage.hide();
    $musicInfoPage.hide();
    $cartPage.show();
    $loginPage.hide();
    $createAccountPage.hide();
    $checkoutPage.hide();
    $invoicePage.hide();
  }
}

// $(window).bind('beforeunload', function(event) {
//   return 'Items in cart will disappear';
  
// })