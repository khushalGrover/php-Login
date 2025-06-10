<?php
$config = require 'config.php';

$conn = new mysqli($config['host'], $config['user'], $config['password'], $config['db_name']);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_POST['id'];
$name = $_POST['name'];
$email = $_POST['email'];

// Update user
$stmt = $conn->prepare("UPDATE users SET name = ?, email = ? WHERE id = ?");
$stmt->bind_param("ssi", $name, $email, $id);

if ($stmt->execute()) {
    echo "✅ User updated successfully.<br>";
    echo "<a href='index.php'>⬅️ Back to All Users</a>";
} else {
    echo "❌ Error updating user: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
