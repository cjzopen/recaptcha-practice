<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: X-Requested-With, Content-Type, Accept');

// $response   = isset($_POST["g-recaptcha-response"]) ? $_POST['g-recaptcha-response'] : null;
// $privatekey = "6LcpDzsUAAAAAK56V74Q_MTPgYaJyAhwytvyRZPe";

// $url= 'https://www.google.com/recaptcha/api/siteverify?secret='.$privatekey.'&response='.$response;

// $context = stream_context_create(array('http'=>array('ignore_errors'=>true)));
// $verifyResponse = file_get_contents($url, FALSE, $context);

// $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$privatekey.'&response='.$response);
// print_r($verifyResponse);
// $responseData = json_decode($verifyResponse);
// if($responseData->success){
// }else{
// }
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
<div class="g-recaptcha" data-sitekey="6LcpDzsUAAAAAM2npS4P_R4_uYYeQHbPMIuBERk-"></div>
<script src='https://www.google.com/recaptcha/api.js'></script>
<script>
  var user = {
    'secret' : '{{ secret key }}',
    'response' : grecaptcha.getResponse()
  };
  $.ajax({
    type: "POST",
    crossDomain: true,
    url: "https://www.google.com/recaptcha/api/siteverify",
    data: user
  }).done(function(data){
    alert(data['success'])
  })
</script>
</body>
</html>
