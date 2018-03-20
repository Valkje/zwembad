<?php
  session_start();

  $uri = $_SESSION['uri'];

  $_SESSION['ingelogd'] = false;
  session_unset(); 
  session_destroy();
  
  if (empty($uri)) {
      header('Location: /');
  } else {
      header('Location: '.$uri);
  }
?>