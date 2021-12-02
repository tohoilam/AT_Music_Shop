let $musicInformation;
let $subLink;
// let $inputId;

function setMusicInfo(MusicId) {
  initializeMusicInfoPage();
  getMusicInfo(MusicId);
}

function initializeMusicInfoPage() {
  $musicInformation = $('#musicInformation');
  $subLink = $('#musicInfoPageHeading .subLink');
  $inputId = $('#inputId');
  console.log($('#addToCartSubmit'));
}

function getMusicInfo(musicId) {
  let xmlHttp = new XMLHttpRequest();
  if (!xmlHttp) {
    alert('Cannot create XMLHttpRequest object!!');
  }
  xmlHttp.onreadystatechange = function() {
    if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
      let response = xmlHttp.responseText;

      $musicInformation.empty().append(response);
      let musicName = $('#infoMusicName').text();
      let musicId = $('#infoMusicId').text();
      $subLink.text(musicName);
      $inputId.val(musicId);
    }
  }
  xmlHttp.open('POST', 'pages/musicInfoPage/getMusicInfo.php', true);
  xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xmlHttp.send(`musicId=${musicId}`);
}

function addToCart(musicId, quantity) {
  let inputQuantity = document.getElementById("inputQuantity");
  if (inputQuantity.validity.valueMissing || inputQuantity.validity.patternMismatch) {
    alert('You MUST enter a quantity between 1 - 999');
    inputQuantity.focus();
    return
  }

  let xmlHttp = new XMLHttpRequest();
  if (!xmlHttp) {
    alert('Cannot create XMLHttpRequest object!!');
  }
  console.log('Send')
  xmlHttp.onreadystatechange = function() {
    if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
      let response = xmlHttp.responseText;
      if (response === 'done') {
        inputQuantity.value = '';
      }
      else {
        alert('Failed adding item into cart!');
      }
    }
  }
  xmlHttp.open('POST', 'pages/musicInfoPage/addToCart.php', true);
  xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xmlHttp.send(`musicId=${musicId}&quantity=${quantity}&userId=${globalUserId}`);
}