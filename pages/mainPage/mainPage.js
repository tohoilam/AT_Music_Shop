let $nav;
let $musicRecordsArea;

$(document).ready(function () {
  initializeMainPage();
  getMusicCategory();
  getMusicRecords();
})

function initializeMainPage() {
  $nav = $('nav');
  $musicRecordsArea = $('#musicRecordsArea');
}

function getMusicCategory() {
  let xmlHttp = new XMLHttpRequest();
  if (!xmlHttp) {
    alert('Cannot create XMLHttpRequest object!!');
  }
  xmlHttp.onreadystatechange = function() {
    if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
      let response = xmlHttp.responseText;

      $nav.empty().append(response);
    }
  }
  xmlHttp.open('POST', 'pages/mainPage/getMusic.php', true);
  xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xmlHttp.send('type=nav');
}

function changeCategory(element) {

  let category = $(element).text();

  let xmlHttp = new XMLHttpRequest();
  if (!xmlHttp) {
    alert('Cannot create XMLHttpRequest object!!');
  }
  xmlHttp.onreadystatechange = function() {
    if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
      let response = xmlHttp.responseText;
      console.log('done')
      $musicRecordsArea.empty().append(response);
      $('#mainPageHeading').text($('#category').text());
      $('#category').hide();
    }
  }
  xmlHttp.open('POST', 'pages/mainPage/getMusic.php', true);
  xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xmlHttp.send(`type=category&category=${category}`);
}

function getMusicRecords() {
  let xmlHttp = new XMLHttpRequest();
  if (!xmlHttp) {
    alert('Cannot create XMLHttpRequest object!!');
  }
  xmlHttp.onreadystatechange = function() {
    if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
      let response = xmlHttp.responseText;

      $musicRecordsArea.empty().append(response);
      $('#mainPageHeading').text($('#category').text());
      $('#category').hide();
    }
  }
  xmlHttp.open('POST', 'pages/mainPage/getMusic.php', true);
  xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xmlHttp.send('type=all');
}

function goMusicInfo(element) {
  changeTab('musicInfo', element.id);
}