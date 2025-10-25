<?php
include 'functions.php';
secure();
require 'reusable/conn.php';
$rows = mysqli_query($connect, "select * from users order by id desc");
?>
<!doctype html><html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>users</title><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"></head><body>
<?php include 'reusable/nav.php'; ?>
<div class="container mt-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="m-0">users</h4>
    <a href="user_create.php" class="btn btn-primary btn-sm">add user</a>
  </div>
  <?php get_message(); ?>
  <div class="table-responsive">
    <table class="table table-striped align-middle">
      <thead><tr><th>id</th><th>image</th><th>name</th><th>email</th><th class="text-end">actions</th></tr></thead>
      <tbody>
        <?php foreach($rows as $r): ?>
        <tr>
          <td><?php echo $r['id']; ?></td>
          <td><?php if($r['image']){ ?><img src="<?php echo $r['image']; ?>" width="40"><?php } ?></td>
          <td><?php echo htmlspecialchars($r['name']); ?></td>
          <td><?php echo htmlspecialchars($r['email']); ?></td>
          <td class="text-end">
            <a class="btn btn-sm btn-outline-secondary" href="user_edit.php?id=<?php echo $r['id']; ?>">edit</a>
            <a class="btn btn-sm btn-outline-danger" href="user_delete.php?id=<?php echo $r['id']; ?>">delete</a>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>
</body></html>
