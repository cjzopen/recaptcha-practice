<?php
header('Access-Control-Allow-Origin: https://www.google.com');
header('Access-Control-Allow-Methods: GET, POST');
header('Access-Control-Allow-Headers: X-Requested-With, Content-Type, Accept');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $secret = '{{ secret key }}';
  $gRecaptchaResponse = isset($_POST['g-response-value']) ? $_POST['g-response-value'] : null;
  $remoteIp = $_SERVER['REMOTE_ADDR'];
// include reCAPTCHA PHP client library
// https://github.com/google/recaptcha
  include_once "/recaptcha/src/autoload.php";
  $recaptcha = new \ReCaptcha\ReCaptcha($secret);
  $resp = $recaptcha->setExpectedHostname($_SERVER['HTTP_HOST'])
                    ->verify($gRecaptchaResponse, $remoteIp);
  if ($resp->isSuccess()) {
    $msg[ending]='success';
  } else {
    $errors = $resp->getErrorCodes();
    $msg['ending']=$errors;
  }
  echo json_encode($msg);
  exit();
}

?>