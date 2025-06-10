<?php
$config = require 'config.php';

$conn = new mysqli($config['host'], $config['user'], $config['password'], $config['db_name']);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get user ID
$id = $_GET['id'] ?? null;

if (!$id) {
    die("Invalid user ID.");
}

// If form submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_name = $_POST['name'];
    $new_email = $_POST['email'];

    $stmt = $conn->prepare("UPDATE users SET name=?, email=? WHERE id=?");
    $stmt->bind_param("ssi", $new_name, $new_email, $id);
    $stmt->execute();

    echo "✅ User updated successfully. <a href='index.php'>Back to list</a>";
    exit;
}

// Fetch existing data
$stmt = $conn->prepare("SELECT * FROM users WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (!$user) {
    die("User not found.");
}
?>

<h2>Edit User</h2>
<form method="post">
    <label>Name:</label><br>
    <input type="text" name="name" value="<?= htmlspecialchars($user['name']) ?>" required><br><br>

    <label>Email:</label><br>
    <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required><br><br>

    <input type="submit" value="Update User">
</form>
