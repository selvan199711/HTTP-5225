<!DOCTYPE html>
<html lang="en">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset="UTF-8">
<title>Week 5</title>
</head>
<body>

<?php
$connect = mysqli_connect(
    'localhost',
    'root',
    '',
    'csv_db 15'
);

if(!$connect){
    die("Connection Failed: " . mysqli_connect_error());
}

$query = "SELECT NAME, HEX FROM colors";
$colors = mysqli_query($connect, $query);

while ($row = mysqli_fetch_assoc($colors)) {
    $name = $row['NAME'];
    $hex  = $row['HEX'];
    echo "<div style='width:100%;height:80px;background:$hex;display:flex;align-items:center;justify-content:center;font-size:20px;color:white;'>$name</div>";
}
?>

</body>
</html>
