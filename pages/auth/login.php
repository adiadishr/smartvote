<?php
$css_module = 'auth';
$title = 'Login';
require '../../config/config.php';
require getBasePath() . 'includes/header.php';
?>

<h1>Login</h1>
<a href="../../index.php">Home</a>
<form action="../../controllers/auth/login.php" method="post">
    <label for="username">Username</label>
    <input type="text" name="username" id="username" required>
    <label for="password">Password</label>
    <input type="password" name="password" id="password" required>
    <button type="submit">Login</button>
    <p>No account?<a href="register.php">Register</a></p>
</form>

<?php
require '../../includes/footer.php';
require '../../includes/footer.php';
?>