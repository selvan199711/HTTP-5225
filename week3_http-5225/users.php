<?php
function getUsers() {
    $url = "https://jsonplaceholder.typicode.com/users";
    $data = file_get_contents($url);
    return json_decode($data, true);
}

$users = getUsers();
?>

<!DOCTYPE html>
<html>
<head>
    <title>User List</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f9f9f9; padding: 20px; }
        h1 { text-align: center; color: #333; }
        .user-card {
            background: white;
            border: 1px solid #ddd;
            border-radius: 8px;
            margin: 10px auto;
            padding: 15px;
            width: 400px;
            box-shadow: 2px 2px 6px rgba(0,0,0,0.1);
        }
        .user-card h3 { margin: 0; color: #0066cc; }
        .user-card p { margin: 5px 0; }
    </style>
</head>
<body>
    <h1>Users from JSONPlaceholder</h1>

    <?php
    for ($i = 0; $i < count($users); $i++) {
        $user = $users[$i];
        echo "<div class='user-card'>";
        echo "<h3>" . htmlspecialchars($user['name']) . "</h3>";
        echo "<p><strong>Email:</strong> " . htmlspecialchars($user['email']) . "</p>";
        echo "<p><strong>Address:</strong> " 
            . htmlspecialchars($user['address']['street']) . ", " 
            . htmlspecialchars($user['address']['city']) . "</p>";
        echo "</div>";
    }
    ?>
</body>
</html>
