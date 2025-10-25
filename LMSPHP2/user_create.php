<?php
include 'functions.php';
// secure();
require 'reusable/conn.php';
if($_SERVER['REQUEST_METHOD']==='POST'){
  $name = trim($_POST['name']??'');
  $email = trim($_POST['email']??'');
  $pass = $_POST['password']??'';
  $img = '';
  if(!empty($_FILES['image']['name'])){ $img = uploadImage($_FILES['image']); }
  $p = md5($pass);
  $q = "insert into users(name,email,password,image) values(?,?,?,?)";
  $s = mysqli_prepare($connect,$q);
  mysqli_stmt_bind_param($s,"ssss",$name,$email,$p,$img);
  $ok = mysqli_stmt_execute($s);
  if($ok){ set_message('user created','success'); header('Location: users.php'); exit; }
  set_message('create failed','danger'); header('Location: user_create.php'); exit;
}
?>
<!doctype html><html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>add user</title><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"></head><body>
<?php include 'reusable/nav.php'; ?>
<div class="container mt-4" style="max-width:560px">
  <h4 class="mb-3">add user</h4>
  <?php get_message(); ?>
  <form method="post" enctype="multipart/form-data">
    <div class="mb-3"><label class="form-label">name</label><input name="name" class="form-control"></div>
    <div class="mb-3"><label class="form-label">email</label><input type="email" name="email" class="form-control"></div>
    <div class="mb-3"><label class="form-label">password</label><input type="password" name="password" class="form-control"></div>
    <div class="mb-3"><label class="form-label">image</label><input type="file" name="image" class="form-control"></div>
    <button class="btn btn-primary">save</button>
  </form>
</div>
</body></html>
