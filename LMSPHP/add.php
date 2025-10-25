<?php
  include('functions.php');
  secure();

  if(isset($_POST['addSchool'])){
    // print_r($_POST);
    $schoolName = $_POST['schoolName'];
    $schoolLevel = $_POST['schoolLevel'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];

    // Connection string
    include('reusable/conn.php');
    $query = "INSERT INTO schools (
    `Board Name`, `School Number`, `School Name`, `School Level`, 
    `School Language`, `School Type`, `School Special Conditions`, 
    `Street`, `City`, `Province`, `Postal Code`, `Phone`, `Fax`, 
    `Grade Range`, `Date Open`, `Email`, `Website`, `Board Website`
  ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = mysqli_prepare($connect, $query);
mysqli_stmt_bind_param($stmt, "ssssssssssssssssss",
  $boardName, $schoolNumber, $schoolName, $schoolLevel,
  $schoolLanguage, $schoolType, $schoolConditions,
  $street, $city, $province, $postal, $phone, $fax,
  $gradeRange, $dateOpen, $email, $website, $boardWebsite
);
    $school = mysqli_query($connect, $query);

    if($school){
      set_message('School was added successfully!', 'success');
      header("Location: index.php"); 
    }else{
      echo "Failed: " . mysqli_error($connect);
    }
  }else{
    echo "You should not be here!";
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ontario Public Schools</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Ontario Public Schools</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="add.php">Add A School</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <div class="container-fluid">
    <div class="container">
      <div class="row">
        <div class="col">
          <h1 class="display-4 mt-5 mb-5">All Schools</h1>
        </div>
      </div>
    </div>
  </div>
  
  <?php 
      include('reusable/conn.php');
      $query = 'SELECT * FROM schools';
      $schools = mysqli_query($connect, $query);
  ?>

  <div class="container-fluid">
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <form action="add.php" method="POST">
          <div class="mb-3">
            <label for="schoolName" class="form-label">School Name</label>
            <input type="text" class="form-control" id="schoolName" name="schoolName" aria-describedby="school Name">
          </div>
          <div class="mb-3">
            <label for="schoolLevel" class="form-label">School Level</label>
            <input type="text" class="form-control" id="schoolLevel" name="schoolLevel">
          </div>
          <div class="mb-3">
            <label for="phone" class="form-label">Phone</label>
            <input type="text" class="form-control" id="phone" name="phone">
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email">
          </div>
          <div class="mb-3">
            <label for="boardName" class="form-label">Board Name</label>
            <input type="text" class="form-control" id="boardName" name="boardName">
          </div>
          <div class="mb-3">
            <label for="schoolNumber" class="form-label">School Number</label>
            <input type="text" class="form-control" id="schoolNumber" name="schoolNumber">
          </div>
          <div class="mb-3">
            <label for="schoolLanguage" class="form-label">School Language</label>
            <input type="text" class="form-control" id="schoolLanguage" name="schoolLanguage">
          </div>
          <div class="mb-3">
            <label for="schoolType" class="form-label">School Type</label>
            <input type="text" class="form-control" id="schoolType" name="schoolType">
          </div>
          <div class="mb-3">
            <label for="schoolConditions" class="form-label">School Special Conditions</label>
            <input type="text" class="form-control" id="schoolConditions" name="schoolConditions">
          </div>
          <div class="mb-3">
            <label for="street" class="form-label">Street</label>
            <input type="text" class="form-control" id="street" name="street">
          </div>
          <div class="mb-3">
            <label for="city" class="form-label">City</label>
            <input type="text" class="form-control" id="city" name="city">
          </div>
          <div class="mb-3">
            <label for="province" class="form-label">Province</label>
            <input type="text" class="form-control" id="province" name="province">
          </div>
          <div class="mb-3">
            <label for="postalCode" class="form-label">Postal Code</label>
            <input type="text" class="form-control" id="postalCode" name="postalCode">
          </div>
          <div class="mb-3">
            <label for="fax" class="form-label">Fax</label>
            <input type="text" class="form-control" id="fax" name="fax">
          </div>
          <div class="mb-3">
            <label for="gradeRange" class="form-label">Grade Range</label>
            <input type="text" class="form-control" id="gradeRange" name="gradeRange">
          </div>
          <div class="mb-3">
            <label for="dateOpen" class="form-label">Date Open</label>
            <input type="text" class="form-control" id="dateOpen" name="dateOpen">
          </div>
          <div class="mb-3">
            <label for="website" class="form-label">Website</label>
            <input type="text" class="form-control" id="website" name="website">
          </div>
          <div class="mb-3">
            <label for="boardWebsite" class="form-label">Board Website</label>
            <input type="text" class="form-control" id="boardWebsite" name="boardWebsite">
          </div>

          <button type="submit" class="btn btn-primary" name="addSchool">Add School</button>
        </form>
      </div>
    </div>
  </div>
</div>



</body>
</html>