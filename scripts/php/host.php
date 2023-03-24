<?php
/** **************************
 * KaraokeSpin.com Host Class
 * **************************
*/ 

class Host {
  private $db;

  public function __construct() {
    // Connect to the database
    $this->db = new mysqli('localhost', 'username', 'password', 'database_name');
  }

  public function login($email, $password) {
    // Check if the email and password are valid
    $query = "SELECT * FROM hosts WHERE email = '$email' AND password = '$password'";
    $result = $this->db->query($query);

    if ($result->num_rows > 0) {
      // Login successful
      session_start();
      $_SESSION['email'] = $email;
      header('Location: /hosting/dashboard.phtml');
      exit;
    } else {
      // Login failed
      header('Location: /login.html'); 
      exit; 
    }
  }

  public function register($name, $email, $password) {
    // Check if the email is already taken
    $query = "SELECT * FROM hosts WHERE email = '$email'";
    $result = $this->db->query($query);

    if ($result->num_rows > 0) {
      // Email is already taken
      return 'Email is already taken';
    } else {
      // Create a new host account
      $query = "INSERT INTO hosts (name, email, password) VALUES ('$name', '$email', '$password')";
      $result = $this->db->query($query);

      if ($result) {
        // Registration successful
        session_start();
        $_SESSION['email'] = $email;
        header('Location: /hosting/dashboard.html');
        exit;
      } else {
        // Registration failed
        header('Location: /login.html'); 
        exit;
      }
    }
  }

  public function logout() {
    // Logout the host
    session_start();
    session_unset();
    session_destroy();
    header('Location: /index.html');
    exit;
  }
}

?>

