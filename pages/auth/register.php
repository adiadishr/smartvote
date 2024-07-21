<?php
$title = 'Register';
$css_module = 'auth';
require '../../config/config.php';
require getBasePath() . 'includes/header.php';
?>

<h1>Register</h1>
<a href="../../index.php">Home</a>
<form action="../../controllers/auth/register.php" method="post">
    <label for="username">Username</label>
    <input type="text" name="username" id="username">
    <label for="password">Password</label>
    <input type="password" name="password" id="password">
    <input type="hidden" name="role" value="user">
    <button type="submit">Register</button>
    <p>Have an account?<a href="login.php">Login</a></p>
</form>

<?php
require '../../includes/footer.php';
?>