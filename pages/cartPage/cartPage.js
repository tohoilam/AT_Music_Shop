
function cartInitialize() {
  let xmlHttp = new XMLHttpRequest();
  if (!xmlHttp) {
    alert('Cannot create XMLHttpRequest object!!');
  }

  xmlHttp.onreadystatechange = function() {

    if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
      let response = xmlHttp.responseText;
      $('#cartArea').empty().append(response);
    }
  }
  xmlHttp.open('POST', 'pages/cartPage/getCart.php', true);
  xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xmlHttp.send();
}

function deleteCartItem(element) {
  let musicId = element.parentElement.querySelector('.cartMusicId').innerText;

  let xmlHttp = new XMLHttpRequest();
  if (!xmlHttp) {
    alert('Cannot create XMLHttpRequest object!!!');
  }
  xmlHttp.onreadystatechange = function() {
    if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
      let response = xmlHttp.responseText;

      if (response == 'done') {
        cartInitialize();
        changeCartTotal();
      }
    }
  }
  xmlHttp.open('POST', 'pages/cartPage/deleteCartItem.php', true);
  xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xmlHttp.send(`MusicId=${musicId}`);
}