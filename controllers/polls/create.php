<?php
require("../../config/config.php");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $organization_id = $_POST['organization_id'];
    $poll = $_POST['poll'];
    $description = $_POST['description'];
    $category_id = $_POST['category_id'];
    $options = $_POST['options'];
    $sql = "INSERT INTO polls (organization_id, poll, description, category_id) VALUES ($organization_id, '$poll', '$description', $category_id)";
    mysqli_query($conn, $sql);
    $poll_id = mysqli_insert_id($conn);
    foreach ($options as $option) {
        $sql = "INSERT INTO options (poll_id, option) VALUES ($poll_id, '$option')";
        mysqli_query($conn, $sql);
    }
    $_SESSION['success'] = 'Poll created successfully';
    header("Location: ../../pages/dashboard/organizations/?organization_id=$organization_id");  
    die;
} else {
    $_SESSION['error'] = 'Invalid request';
    header("Location: ../../pages/dashboard/");
    die;
}
