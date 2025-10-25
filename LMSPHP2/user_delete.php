<?php
include 'functions.php';
secure();
require 'reusable/conn.php';
$id = intval($_GET['id'] ?? 0);
mysqli_query($connect,"delete from users where id=".$id);
set_message('user deleted','danger');
header('Location: users.php');
