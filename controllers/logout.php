<?php

  setcookie('user_id', '', time());
  setcookie('session_id', '', time());
  $um->remove_session($user['id']);
  header('Location: ./index.php');