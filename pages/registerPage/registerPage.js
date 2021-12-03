

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
        $('#errorPage > h1').text('Account created! Welcome');
        changeTab('errorPage', null);

        setTimeout(() => {
          $('#registerUsername').val('');
          $('#registerPassword').val('');
          changeTab('signin', null);
          $('#registerUsername').focus();
        }, 3000);
      }
      else if (response === 'user_exists') {
        $('#errorPage > h1').text('Account already existed');
        changeTab('errorPage', null);

        setTimeout(() => {
          $('#registerUsername').val('');
          $('#registerPassword').val('');
          changeTab('register', null);
          $('#registerUsername').focus();
        }, 3000);

      }
    }
  }
  xmlHttp.open('POST', 'pages/registerPage/verifyRegister.php', true);
  xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xmlHttp.send(`username=${username}&password=${password}`);
}