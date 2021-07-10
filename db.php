<?php
  $servername = 'localhost';
  $username = 'root';
  $password = '';
  $db = 'rsvp';

  $conn = new mysqli($servername, $username, $password, $db);

  if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
  }
?>
