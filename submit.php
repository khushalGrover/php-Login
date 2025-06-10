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
echo "<a href='displayUser.php'>display all users</a><br>";
echo " <a href='search.php'>Search</a><br>";

//get form data safely
$name = $_POST['name'];
$email = $_POST['email'];

//insert query
$sql = "INSERT INTO users (name, email) VALUES(?,?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $name, $email);

if($stmt->execute()) {
    echo "new user added successfullly! <br>";
    echo "<a href='index.php'>Add Another user</a><br>";
}
else {
    echo "error while adding user" . $stmt->error;
}

$stmt->close();
$conn->close();

?>