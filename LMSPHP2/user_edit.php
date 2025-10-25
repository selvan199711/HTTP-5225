<?php
include 'functions.php';
secure();
require 'reusable/conn.php';
$id = intval($_GET['id'] ?? 0);
$r = mysqli_query($connect,"select * from users where id=".$id);
$u = mysqli_fetch_assoc($r);
if(!$u){ set_message('not found','danger'); header('Location: users.php'); exit; }
if($_SERVER['REQUEST_METHOD']==='POST'){
  $name = trim($_POST['name']??'');
  $email = trim($_POST['email']??'');
  $pass = $_POST['password']??'';
  $img = $u['image'];
  if(!empty($_FILES['image']['name'])){ $img = uploadImage($_FILES['image']); }
  if($pass!==''){
    $p = md5($pass);
    $q = "update users set name=?, email=?, password=?, image=? where id=?";
    $s = mysqli_prepare($connect,$q);
    mysqli_stmt_bind_param($s,"ssssi",$name,$email,$p,$img,$id);
  }else{
    $q = "update users set name=?, email=?, image=? where id=?";
    $s = mysqli_prepare($connect,$q);
    mysqli_stmt_bind_param($s,"sssi",$name,$email,$img,$id);
  }
  $ok = mysqli_stmt_execute($s);
  if($ok){ set_message('user updated','success'); header('Location: users.php'); exit; }
  set_message('update failed','danger'); header('Location: user_edit.php?id='.$id); exit;
}
?>
<!doctype html><html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>edit user</title><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"></head><body>
<?php include 'reusable/nav.php'; ?>
<div class="container mt-4" style="max-width:560px">
  <h4 class="mb-3">edit user</h4>
  <?php get_message(); ?>
  <form method="post" enctype="multipart/form-data">
    <div class="mb-3"><label class="form-label">name</label><input name="name" class="form-control" value="<?php echo htmlspecialchars($u['name']); ?>"></div>
    <div class="mb-3"><label class="form-label">email</label><input type="email" name="email" class="form-control" value="<?php echo htmlspecialchars($u['email']); ?>"></div>
    <div class="mb-3"><label class="form-label">new password</label><input type="password" name="password" class="form-control"></div>
    <div class="mb-3"><label class="form-label">image</label><input type="file" name="image" class="form-control"></div>
    <div class="mb-3"><?php if($u['image']){ ?><img src="<?php echo $u['image']; ?>" width="60"><?php } ?></div>
    <button class="btn btn-primary">save</button>
  </form>
</div>
</body></html>
