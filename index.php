<!DOCTYPE html>
<html>
<head>
    <title>Add User</title>
</head>
<body>
    <a href='displayUser.php'>display all users</a><br>
    
    <!-- search btn -->
    <form action='search.php' method='get'>
        <input type='text' name='query' placeholder='Search by name'>
        <input type='submit' value='Search'>
    </form><br>

    <h2>Add New User</h2>
    <form action="submit.php" method="post">
        <label>Name:</label><br>
        <input type="text" name="name" required><br><br>

        <label>Email:</label><br>
        <input type="email" name="email" required><br><br>

        <input type="submit" value="Add User">
    </form>
</body>
</html>
