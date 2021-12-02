

function registerFormSubmit() {
  let username = $('#RegisterForm #registerUsername').val();
  let password = $('#RegisterForm #registerPassword').val();
  let xmlHttp = new XMLHttpRequest();
  if (!xmlHttp) {
    alert('Cannot create XMLHttpRequest object!!');
  }

  xmlHttp.onreadystatechange = function() {

    if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
      let response = xmlHttp.responseText;
      if (response === 'done') {
        globalUserId = username;
        changeTab('main', null);
      }
      else if (response === 'user_exists') {
        $('#registerError').text('Username existed! Please login or choose a different username!');
        $('#registerUsername').val('');
        $('#registerPassword').val('');
        $('#registerUsername').focus();
      }
    }
  }
  xmlHttp.open('POST', 'pages/registerPage/verifyRegister.php', true);
  xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xmlHttp.send(`username=${username}&password=${password}`);
}