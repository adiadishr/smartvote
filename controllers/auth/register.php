<?php
require_once '../../config/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['username']) && !empty($_POST['password']) && isset($_POST['role'])) {

        $username = $_POST['username'];
        $password = $_POST['password'];
        $role = $_POST['role'];
        $role == 'admin' ? $role = 1 : $role = 2;

        if (preg_match('/^[0-9]/', $username)) {
            $_SESSION['error'] = 'Username must start with a letter';
            header('Location: ../../pages/auth/register.php');
            die;
        }

        if (strlen($password) <= 8) {
            $_SESSION['error'] = 'Password must be at least 8 characters';
            header('Location: ../../pages/auth/register.php');
            die;
        }

        $sql = "SELECT * FROM users WHERE username = '$username'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $_SESSION['error'] = 'Username is already taken';
            header('Location: ../../pages/auth/register.php');
            die;
        }

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (username, password, role_id) VALUES ('$username', '$hashed_password', '$role')";
        $result = $conn->query($sql);

        if ($result) {
            $_SESSION['success'] = 'Registration successful';
            header('Location: ../../pages/auth/login.php');
            die;
        } else {
            $_SESSION['error'] = 'Registration failed';
            header('Location: ../../pages/auth/register.php');
            die;
        }
    } else {
        $_SESSION['error'] = 'Please fill in all fields';
        header('Location: ../../pages/auth/register.php');
        die;
    }
}
?>