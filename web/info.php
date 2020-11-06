<?php
  $dbhost = 'localhost';
  $dbuser = 'tiqal';
  $dbpass = 'prueba';
  $dbdb= 'agricola';
  $con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbdb);

  if(! $con ){
     die('Could not connect: ');
  }
  echo 'Connected successfully';
  mysqli_close($con);