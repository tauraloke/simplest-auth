<?php

  $dbname = 'french';
  $dsn = 'mysql:dbname='.$dbname.';host=127.0.0.1';
  $user = 'root';
  $password = '';
  $um = false;


  try {
    $dbc = new PDO($dsn, $user, $password);
    return $dbc;
  } catch (PDOException $e) {
    die('Connection failed: ' . $e->getMessage());
  }

