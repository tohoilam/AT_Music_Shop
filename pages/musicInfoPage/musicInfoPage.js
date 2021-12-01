let $musicInfoPageArea;

function setMusicInfo(MusicId) {
  console.log(MusicId);
  initializeMusicInfoPage();
  getMusicInfo(MusicId);
}

function initializeMusicInfoPage() {
  $musicInfoPageArea = $('#musicInfoPageArea');
}

function getMusicInfo(musicId) {
  let xmlHttp = new XMLHttpRequest();
  if (!xmlHttp) {
    alert('Cannot create XMLHttpRequest object!!');
  }
  xmlHttp.onreadystatechange = function() {
    if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
      let response = xmlHttp.responseText;

      $musicInfoPageArea.empty().append(response);
    }
  }
  xmlHttp.open('POST', 'pages/musicInfoPage/getMusicInfo.php', true);
  xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xmlHttp.send(`musicId=${musicId}`)
}