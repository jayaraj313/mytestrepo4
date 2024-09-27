<?php
class dbHandler {
  private $conn;
  function __construct() {
    $this->conn = new mysqli('localhost', 'root', '', 'test_db');
    if ($this->conn->connect_error) {
      die('Failed to connect to MySQL - ' . $this->conn->connect_error);
    }
  }
##
  function get_data($tbl) {
    $sql = "SELECT * FROM $tbl";
    $result = $this->conn->query($sql);
    $rows = [];
    if ($result->num_rows > 0) {
      while($r = $result->fetch_assoc()) {
        $rows[] = $r;
      }
    }
    return $rows;
  }

  function add_record($data) {
    $name = $data['name'];
    $email = $data['email'];
    $sql = "INSERT INTO users (name, email) VALUES ('$name', '$email')";
    if ($this->conn->query($sql) === TRUE) {
      return true;
    } else {
      return false;
    }
  }

  function __destruct() {
    $this->conn->close();
  }
}

$handler = new dbHandler();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $add = $handler->add_record($_POST);
  if ($add) {
    echo 'Record added successfully.';
  } else {
    echo 'Error adding record.';
  }
}

$users = $handler->get_data('users');
echo '<h2>User List</h2>';
foreach ($users as $user) {
  echo 'Name: ' . $user['name'] . ' - Email: ' . $user['email'] . '<br>';
}
?>
