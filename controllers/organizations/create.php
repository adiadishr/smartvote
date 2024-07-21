<?php
require '../../config/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $organization = sanitize($_POST['organization']);
    $code = sanitize($_POST['code']);
    $user_id = $_SESSION['user_id'];
    $sql = "INSERT INTO organizations (organization, code, user_id) VALUES ('$organization', '$code', $user_id);";
    mysqli_query($conn, $sql);
    $_SESSION['success'] = 'New organization ' . $organization . ' created';
    $sql = "INSERT INTO users_organizations (organization_id, user_id) VALUES ((SELECT id FROM organizations WHERE code = '$code'), $user_id);";
    mysqli_query($conn, $sql);
    header('Location: ../../pages/dashboard/');
    die;
} else {
    $_SESSION['error'] = 'Invalid request';
    header('Location: ../../pages/dashboard');
    die;
}
