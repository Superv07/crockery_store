<!-- frontend/user/login.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
    <!-- Add any additional styles or scripts here -->
    <style>
        /* Add your styles */
    </style>
</head>
<body>

<header>
    <h1>User Login</h1>
    <!-- Add any header content or navigation links if needed -->
</header>

<section>
    <!-- Your login form goes here -->
    <form action="../../backend/user/login.php" method="post">
        <label for="username">Username:</label>
        <input type="text" name="username" required>

        <label for="password">Password:</label>
        <input type="password" name="password" required>

        <input type="submit" value="Login">
    </form>
</section>

</body>
</html>
