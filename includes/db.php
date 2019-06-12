<?php

  define('_PRODUCTION_',false);

  if (_PRODUCTION_=== true) {
    ini_set('display_errors',0);
    ini_set('error_reporting',E_ALL ^E_NOTICE ^E_WARNING);
  }else{
    ini_set('display_errors',1);
    ini_set('error_reporting',E_ALL ^E_NOTICE);
  }

  $DSN='mysql:host = localhost; dbname=Blog_CMS';
  $connecting_db = new PDO($DSN,'root','');

?>
