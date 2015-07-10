<?php

if(isset($_POST['username']) and isset($_POST['password'])) {
  $user = $um->authentificate($_POST['username'], $_POST['password']);
  if($user) {
    $duration = 3600;
    $id = $user['id'];
    setcookie('user_id', $id, time()+$duration);
    $sid = md5(time());
    setcookie('session_id', $sid, time()+$duration);
    $um->save_session($id, $sid);
    header('Location: ./index.php');
    exit;    
  }
  

  
}