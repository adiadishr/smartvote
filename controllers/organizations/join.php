<?php
require '../../config/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $organization = sanitize($_POST['organization']);
    $sql = "SELECT * FROM organizations WHERE code = '$organization';";
    $result = mysqli_query($conn, $sql);
    if ($result->num_rows == 0) {
        $_SESSION['error'] = 'Invalid organization';
        header('Location: ../../pages/dashboard');
        die;
    }
    $row = $result->fetch_assoc();
    $sql = "SELECT * FROM users_organizations WHERE user_id = {$_SESSION['user_id']} AND organization_id = {$row['id']}";
    $result = mysqli_query($conn, $sql);
    if ($result->num_rows > 0) {
        $_SESSION['error'] = 'You are already a member of ' . $row['organization'];
        header('Location: ../../pages/dashboard');
        die;
    }
    $user_id = $_SESSION['user_id'];
    $sql = "INSERT INTO users_organizations (organization_id, user_id) VALUES ({$row['id']}, $user_id);";
    mysqli_query($conn, $sql);
    $_SESSION['success'] = 'You have joined the organization ' . $row['organization'];
    header('Location: ../../pages/dashboard');
    die;
}
