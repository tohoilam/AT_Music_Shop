

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
        changeTab('main', null);
      }
      else {
        $('#errorPage > h1').text('Invalid login, please login again.');
        changeTab('errorPage', null);

        setTimeout(() => {
          $('#loginUsername').val('');
          $('#loginPassword').val('');
          changeTab('signin', null);
          $('#loginUsername').focus();
        }, 3000);
        
      }
    }
  }
  xmlHttp.open('POST', 'pages/loginPage/verifyLogin.php', true);
  xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xmlHttp.send(`username=${username}&password=${password}`);
}