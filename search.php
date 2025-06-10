<?php
$host = "localhost";
$user = 'root';
$db_name = 'text_db';
$password = '';

$conn = new mysqli($host, $user, $password, $db_name);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$query = $_GET['query'];

$sql = "SELECT * FROM users WHERE name LIKE ?";
$searchTerm = "%" . $query . "%";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $searchTerm);
$stmt->execute();
$result = $stmt->get_result();

echo "<h1>Search Results for '$query'</h1>";
echo "<a href='index.php'>⬅️ Back to All Users</a><br><br>";

if ($result->num_rows > 0) {
    echo "<table border='1' cellpadding='8'>";
    echo "<tr><th>ID</th><th>Name</th><th>Email</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['id']) . "</td>";
        echo "<td>" . htmlspecialchars($row['name']) . "</td>";
        echo "<td>" . htmlspecialchars($row['email']) . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No matching users found.";
}

$stmt->close();
$conn->close();
?>
