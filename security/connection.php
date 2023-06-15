<?php

$con = mysqli_connect("localhost","root","","db_postercare");
// $con = mysqli_connect("localhost","u270883250_adopt","b0YoBhJwjioE","u270883250_adopt");
// Check connection

if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
?>