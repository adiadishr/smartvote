<?php
require_once '../../config/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['username']) && !empty($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM users WHERE username = '$username'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if (password_verify($password, $row['password'])) {
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['username'] = $row['username'];
                $_SESSION['role'] = $row['role_id'];
                if ($_SESSION['role'] == 1) {
                    header('Location: ../../pages/admin');
                    die;
                } else if ($_SESSION['role'] == 2 || $_SESSION['role'] == 3) {
                    header('Location: ../../pages/dashboard');
                    die;
                }
            } else {
                $_SESSION['error'] = 'Incorrect password';
                header('Location: ../../pages/auth/login.php');
                die;
            }
        } else {
            $_SESSION['error'] = 'Incorrect username';
            header('Location: ../../pages/auth/login.php');
            die;
        }
    }
}
?>