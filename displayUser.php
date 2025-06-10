<?php
$host = "localhost";
$user = 'root';
$db_name = 'text_db';
$password = '';

//creat connection
$conn = new mysqli($host, $user, $password, $db_name);

// check DB connection 
if( $conn->connect_error) {
    die("Connection failed to connect DB:" . $conn->connect_error);
}

$sql = "SELECT * from users";
$result = $conn->query($sql);
echo " <a href='index.php'>add new user</a><br>";


echo "<form action='search.php' method='get'>";
echo "<input type='text' name='query' placeholder='Search by name'>";
echo "<input type='submit' value='Search'>";
echo "</form><br>";

echo "<h1>User Details</h1>";
if($result && $result->num_rows > 0)
{
    echo "<table border='1' cellpadding='8'>";
    echo "<tr><th> ID</th> <th> Name</th> <th> Email</th> <th>Edit</th> <th>Delete</th></tr>";

    while($row = $result->fetch_assoc()) {
        echo "<tr>";
            echo "<td>" .htmlspecialchars($row['id']) . " </td>";
            echo " <td>" .htmlspecialchars($row['name']) . " </td> "; 
            echo "<td>" .htmlspecialchars($row['email']) . " </td>  ";
            echo "<td><a href='edit.php?id=" . htmlspecialchars($row['id']) . "'>✏️ Edit</a></td>";
            echo "<td><a href='delete.php?id=" . htmlspecialchars($row['id']) . "' onclick='return confirm(\"Are you sure?\")'>❌ Delete</a></td>";
        echo "</tr>";
    }
}

$stmt->close();
$conn->close();
?>