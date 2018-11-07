<?php
header('Access-Control-Allow-Origin: https://www.google.com/');
// header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
// header('Access-Control-Allow-Headers: X-Requested-With, Content-Type, Accept');
?>
<!DOCTYPE html>
<html lang="zh">
<head>
  <meta charset="UTF-8" />
  <title></title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
  <meta http-equiv="x-ua-compatible" content="IE=edge">
  <meta name="apple-mobile-web-app-capable" content="yes"/>
  <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
</head>
<body>
<form id="consult_form" method="post" name="consult_form" onsubmit="return formCheck();">
  <div class="g-recaptcha" data-sitekey="6LcpDzsUAAAAAM2npS4P_R4_uYYeQHbPMIuBERk-"></div>
  <input type="submit">
</form>
<script src='https://www.google.com/recaptcha/api.js'></script>
<script>
function formCheck(){
  var $body = (window.opera) ? (document.compatMode == "CSS1Compat" ? $('html') : $('body')) : $('html,body');
  var pattern = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
  var isPass = true;
  var t=0;

  if(isPass){
    // var recaptcha = $('#consult_form .g-recaptcha-response').val();
    console.log(grecaptcha.getResponse());
    var user = {
      'response' : grecaptcha.getResponse(),
      'secret' : '{{   }}'
    };

    $.ajax({
      type: "POST",
      crossDomain: true,
      url: "post.php",
      data: user,
      success: function(data){
        data = JSON.parse(data);
        console.log(data);
      },
      error: function(x,e){
        var txt;
        if (x.status==0) {
          alert('You are offline!!\n Please Check Your Network.');
          txt='offline';
        } else if(x.status==404) {
          alert('Requested URL not found.\n請再試一次，或嘗試聯絡客服');
          txt='Requested URL not found';
        } else if(x.status==500) {
          alert('Internel Server Error.\n請再試一次，或嘗試聯絡客服');
          txt='Internel Server Error';
        } else if(e=='parsererror') {
          alert('Error.\nParsing JSON Request failed.\n請再試一次，或嘗試聯絡客服');
          txt='JSON Request failed';
        } else if(e=='timeout'){
          alert('Request Time out.');
          txt='Time out';
        } else {
          alert('Unknow Error.\n請再試一次，或嘗試聯絡客服');
          txt='Unknow Error';
        }
        console.log(x.responseText)
      },
      complete: function(){
        grecaptcha.reset();
      }
    });

  }

  return false;
};
</script>
</body>
</html>