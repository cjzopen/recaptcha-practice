<?php
header('Access-Control-Allow-Origin: https://www.google.com');
header('Access-Control-Allow-Methods: GET, POST');
header('Access-Control-Allow-Headers: X-Requested-With, Content-Type, Accept');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $secret = '{{ secret key }}';
  $gRecaptchaResponse = isset($_POST['g-response-response']) ? $_POST['g-response-response'] : null;
  $remoteIp = $_SERVER['REMOTE_ADDR'];
  $domainName = $_SERVER['HTTP_HOST'];

// include reCAPTCHA PHP client library
// https://github.com/google/recaptcha
  include_once "/recaptcha/src/autoload.php";
  $recaptcha = new \ReCaptcha\ReCaptcha($secret);
  $resp = $recaptcha->setExpectedHostname($domainName)
                  ->setExpectedAction('homepage')
                  ->setScoreThreshold(0.5)
                  ->verify($gRecaptchaResponse, $remoteIp);
  if ($resp->isSuccess()) {
    $msg['ending']=$resp->toArray();
  } else {
    $errors = $resp->getErrorCodes();
    $msg['ending']=$errors;
  }
  echo json_encode($msg);
  exit();
}

?>