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
}

async function addToCart(musicId, quantity) {
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
  
  xmlHttp.onreadystatechange = function() {
    if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
      let response = xmlHttp.responseText;
      if (response.substring(0, 4) === 'done') {
        inputQuantity.value = '';
        let totalQuantity = response.substring(4);
        $('#cartButton').text(`Cart (${totalQuantity})`)
      }
      else if (response === 'No_UserId_In_Session') {
        alert('User Id is not set in Session');
      }
      else {
        alert('Failed adding item!');
      }
    }
  }
  xmlHttp.open('POST', 'pages/musicInfoPage/addToCart.php', true);
  xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

  let UserId = await getUserId();
  if (UserId) {
    xmlHttp.send(`mode=user&musicId=${musicId}&quantity=${quantity}`);
  }
  else {
    xmlHttp.send(`mode=guest&musicId=${musicId}&quantity=${quantity}`);
  }
}