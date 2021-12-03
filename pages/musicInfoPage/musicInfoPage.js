let $musicInformation;
let $subLink;
// let $inputId;

async function setMusicInfo(MusicId) {
  initializeMusicInfoPage();
  await getMusicInfo(MusicId);
}

function initializeMusicInfoPage() {
  $musicInformation = $('#musicInformation');
  $subLink = $('#musicInfoPageHeading .subLink');
  $inputId = $('#inputId');
  console.log($('#addToCartSubmit'));
}

async function getMusicInfo(musicId) {
  try {
    let response = await fetch(`pages/musicInfoPage/getMusicInfo.php?musicId=${musicId}`);
    if (response.status == 200) {
      let data = await response.text();

      $musicInformation.empty().append(data);
      let musicName = $('#infoMusicName').text();
      let musicId = $('#infoMusicId').text();
      $subLink.text(musicName);
      $inputId.val(musicId);
    }
    else {
      alert("HTTP return status:", response.status);
    }
  }
  catch (error) {
    alert("Fetch music info resulted in an Error!")
  }
  // let xmlHttp = new XMLHttpRequest();
  // if (!xmlHttp) {
  //   alert('Cannot create XMLHttpRequest object!!');
  // }
  // xmlHttp.onreadystatechange = function() {
  //   if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
  //     let response = xmlHttp.responseText;

  //     $musicInformation.empty().append(response);
  //     let musicName = $('#infoMusicName').text();
  //     let musicId = $('#infoMusicId').text();
  //     $subLink.text(musicName);
  //     $inputId.val(musicId);
  //   }
  // }
  // xmlHttp.open('POST', 'pages/musicInfoPage/getMusicInfo.php', true);
  // xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  // xmlHttp.send(`musicId=${musicId}`);

}

async function addToCart(musicId, quantity) {
  let inputQuantity = document.getElementById("inputQuantity");
  if (inputQuantity.validity.valueMissing || inputQuantity.validity.patternMismatch) {
    alert('You MUST enter a quantity between 1 - 999');
    inputQuantity.focus();
    return
  }

  let UserId = await getUserId();
  if (UserId) {
    console.log('Send api to Cart with UserId:', UserId);
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
        else if (response === 'No_UserId_In_Session') {
          alert('User Id is not set in Session');
        }
        else {
          alert('Failed adding item into cart!');
        }
      }
    }
    xmlHttp.open('POST', 'pages/musicInfoPage/addToCart.php', true);
    xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlHttp.send(`musicId=${musicId}&quantity=${quantity}`);
  }
  else {
    console.log("not logged in");
  }
}