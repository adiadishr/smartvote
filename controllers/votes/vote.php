<?php
require '../../config/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    print_r($_POST);
    $poll_id = sanitize($_GET['poll_id']);
    $option_id = sanitize($_POST['option_id']);
    $user_id = $_SESSION['user_id'];
    $sql = "INSERT INTO votes (poll_id, option_id, user_id) VALUES ($poll_id, $option_id, $user_id);";
    mysqli_query($conn, $sql);
    $_SESSION['success'] = 'Vote casted';
    header('Location: ../../pages/dashboard/organizations?organization_id=' . $_POST['organization_id']);
    die;
} else {
    $_SESSION['error'] = 'Invalid request';
    header('Location: ../../pages/dashboard/polls');
    die;
}
