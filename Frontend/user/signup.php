<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Signup</title>
</head>
<body>

<h2>User Signup</h2>

<form action="../../backend/user/signup.php" method="post">
    <label for="username">Username:</label>
    <input type="text" name="username" required>

    <label for="email">Email:</label>
    <input type="email" name="email" required>

    <label for="password">Password:</label>
    <input type="password" name="password" required>

    <label for="confirm_password">Confirm Password:</label>
    <input type="password" name="confirm_password" required>

    <input type="submit" value="Signup">
</form>

</body>
</html>
