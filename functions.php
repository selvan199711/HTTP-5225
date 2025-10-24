<?php

  session_start();

  function secure(){
    if(!isset($_SESSION['id'])){
      header('Location: login.php');
    }
  }

  function set_message($message, $className){
    $_SESSION['message'] = $message;
    $_SESSION['className'] = $className;
  }

  function get_message(){
    if(isset($_SESSION['message'])){
      echo 
        '<div class="alert alert-' . $_SESSION['className'] . '" role="alert">' . 
          $_SESSION['message'] 
        .'</div>';
        unset($_SESSION['message']);
        unset($_SESSION['className']);
    }
  }

  function uploadImage($file) {
    $targetDir = "uploads/";
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0777, true);
    }

    $targetFile = $targetDir . basename($file["name"]);
    move_uploaded_file($file["tmp_name"], $targetFile);
    return $targetFile;
  }

?>

<?php
function connectDB() {
    $host = "localhost";
    $user = "root";
    $pass = "";
    $dbname = "publicschools";

    $conn = new mysqli($host, $user, $pass, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}
?>
