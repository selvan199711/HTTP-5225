<?php
include("conn.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Favourite Tamil Actors</title>
  <style>
    body {
      font-family: Arial;
      background-color: #f5f5f5;
      margin: 20px;
    }
    .actor_card {
      background: #fff;
      padding: 10px;
      margin-bottom: 10px;
      border-radius: 5px;
      box-shadow: 0 0 3px #bbb;
    }
    .superstar {
      color: green;
      font-weight: bold;
    }
    .newgen {
      color: blue;
    }
  </style>
</head>
<body>
  <h2>My Favourite Tamil Actors</h2>

  <?php
  $sql = "select * from tamil_actors order by debut_year asc";
  $data = mysqli_query($conn, $sql);

  if (mysqli_num_rows($data) > 0) {
    while ($item = mysqli_fetch_assoc($data)) {
      echo "<div class='actor_card'>";
      echo "<b>Name:</b> " . $item['actor_name'] . "<br>";
      echo "Movies Count: " . $item['movies_count'] . "<br>";
      echo "Debut Year: " . $item['debut_year'] . "<br>";
      echo "Famous Movie: " . $item['famous_movie'] . "<br>";

      if ($item['debut_year'] < 2000) {
        echo "<span class='superstar'>Senior Actor</span><br>";
      } else {
        echo "<span class='newgen'>New Generation Actor</span><br>";
      }

      echo "Birth Date: " . $item['birth_date'] . "<br>";
      echo "</div>";
    }
  } else {
    echo "No records found.";
  }

  mysqli_close($conn);
  ?>
</body>
</html>
