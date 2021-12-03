

function loginFormSubmit() {
  let username = $('#LoginForm #loginUsername').val();
  let password = $('#LoginForm #loginPassword').val();

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
      else if (response === 'wrong_password') {
        $('#loginError').text('Incorrect Password');
        $('#loginPassword').val('');
        $('#loginPassword').focus();
      }
      else {
        $('#loginError').text('Account doesn\'t exist! Please make sure you enter an existing account!');
        $('#loginUsername').val('');
        $('#loginPassword').val('');
        $('#loginUsername').focus();
      }
    }
  }
  xmlHttp.open('POST', 'pages/loginPage/verifyLogin.php', true);
  xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xmlHttp.send(`username=${username}&password=${password}&session_id=${globalSessionId}`);
}