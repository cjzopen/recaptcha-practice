<?php
header('Access-Control-Allow-Origin: https://www.google.com');
header('Access-Control-Allow-Methods: GET, POST');
header('Access-Control-Allow-Headers: X-Requested-With, Content-Type, Accept');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {


  $response   = isset($_POST['response']) ? $_POST['response'] : null;
  $privatekey = "{{ secret key }}";
  $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$privatekey.'&response='.$response);
  $responseData = json_decode($verifyResponse);
  if($responseData->success){
    $msg['ending'] = 'success';
  }else{
    $msg['ending'] = 'recaptchaNoChecked';
  }

  // $ch = curl_init();
  // curl_setopt($ch, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
  // curl_setopt($ch, CURLOPT_HEADER, 0);
  // curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  // curl_setopt($ch, CURLOPT_POST, 1);
  // curl_setopt($ch, CURLOPT_POSTFIELDS, array(
  //     'secret' => $privatekey,
  //     'response' => $response,
  //     'remoteip' => $_SERVER['REMOTE_ADDR']
  // ));

  // $resp = json_decode(curl_exec($ch));
  // $msg['c'] =$resp;
  // curl_close($ch);
  // $msg['f']=$response;
  // if ($resp->success) {
  //   $msg['ending'] = 'success';
  // }else{
  //   $msg['ending'] = 'recaptchaNoChecked';
  // }

  echo json_encode($msg);
  exit();
}

// if no POST
header('Location: index.php');


