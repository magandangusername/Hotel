<?php
  $servername = 'localhost';
  $username = 'root';
  $password = '';
  $db = 'mondstadt_hotel';

  $conn = new mysqli($servername, $username, $password, $db);

  if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
  }
?>
