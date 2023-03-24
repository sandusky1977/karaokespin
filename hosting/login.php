<?php
require_once '../scripts/php/host.php';

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Get the email and password from the form
  $email = $_POST['email'];
  $password = $_POST['password'];

  // Attempt to log in the host
  $host = new Host();
  $result = $host->login($email, $password);

  exit;
}