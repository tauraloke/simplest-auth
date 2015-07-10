<?php

  define('APP_ROOT', dirname(__FILE__));
  require_once(APP_ROOT."/lib/UserModel.php");
  
  $db_connection = require_once(APP_ROOT."/settings/db.php");
  $um = new UserModel($db_connection, 'users');
  $user_id = isset($_COOKIE['user_id']) ? $_COOKIE['user_id'] : '';
  $session_id = isset($_COOKIE['session_id']) ? $_COOKIE['session_id'] : '';
  $user = $um->authorize($user_id, $session_id);
    
  $action = preg_replace("/(\.php)|([^a-z0-9])/i", '', basename($_SERVER['REQUEST_URI']));
  if(!file_exists(APP_ROOT."/controllers/{$action}.php") and !file_exists(APP_ROOT."/views/{$action}.php")) {
    $action = 'index';
  }
  $page_header = "Demo";
  require_once(APP_ROOT."/controllers/{$action}.php");
  require_once(APP_ROOT."/template.php");
