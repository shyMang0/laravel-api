<?php
echo "Hello world <br />";

$mysqli = new mysqli("127.0.0.1","bghsample","1234567890","bghsample");
 
// Check connection
if ($mysqli -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
}
 
echo "Connected <br />";
echo "Hello rin -jiison pogi<br>";

phpinfo();