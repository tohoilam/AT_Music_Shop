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
  xmlHttp.open('GET', 'pages/mainPage/getMusic.php?type=nav', true);
  // xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xmlHttp.send();
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
      $('#mainLinkPart > .subLink').text(category);
      $mainLinkPart.show();
      $('#category').hide();
    }
  }
  xmlHttp.open('GET', `pages/mainPage/getMusic.php?type=category&category=${category}`, true);
  // xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xmlHttp.send();
}

async function getMusicRecords() {
  // let xmlHttp = new XMLHttpRequest();
  // if (!xmlHttp) {
  //   alert('Cannot create XMLHttpRequest object!!');
  // }
  // xmlHttp.onreadystatechange = function() {
  //   if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
  //     let response = xmlHttp.responseText;

  //     $musicRecordsArea.empty().append(response);
  //     $('#mainPageHeading').text($('#category').text());
  //     $('#category').hide();
  //   }
  // }
  // xmlHttp.open('GET', 'pages/mainPage/getMusic.php?type=all', true);
  // xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  // xmlHttp.send();

  try {
    let response = await fetch('pages/mainPage/getMusic.php?type=all');
    if (response.status == 200) {
      let data = await response.text();
      $musicRecordsArea.empty().append(data);
      let category = $('#category').text();
      $('#mainPageHeading').text(category);
      $mainLinkPart.hide();
      $('#category').hide();

    }
    else {
      alert('HTTP return status:', response.status);
    }
  }
  catch (error) {
    alert('Fetch all music records resulted in an error!');
  }
}

function goMusicInfo(element) {
  changeTab('musicInfo', element.parentElement.id);
}