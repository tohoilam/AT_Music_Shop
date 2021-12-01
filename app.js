let $topBar, $mainPage, $musicInfoPage, $cartPage, $loginPage, $createAccountPage, $checkoutPage, $invoicePage;

$(document).ready(function() {
  $topBar = $('#topBar');
  $mainPage = $('#mainPage');
  $musicInfoPage = $('#musicInfoPage');
  $cartPage = $('#cartPage');
  $loginPage = $('#loginPage');
  $createAccountPage = $('#createAccountPage');
  $checkoutPage = $('#checkoutPage');
  $invoicePage = $('#invoicePage');

  $mainPage.show();
  $musicInfoPage.hide();
  $cartPage.hide();
  $loginPage.hide();
  $createAccountPage.hide();
  $checkoutPage.hide();
  $invoicePage.hide();
})

function changeTab(tabType, param) {
  if (tabType === 'musicInfo') {
    // param = music id
    $mainPage.hide();
    $musicInfoPage.show();
    setMusicInfo(param);
  }
}

