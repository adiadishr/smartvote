<?php
require '../../config/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $category = sanitize($_POST['category']);
    $organization_id = sanitize($_POST['organization_id']);
    $sql = "INSERT INTO categories (organization_id, category) VALUES ($organization_id, '$category');";
    mysqli_query($conn, $sql);
    $_SESSION['success'] = 'Category created';
    header('Location: ../../pages/dashboard/categories/?organization_id=' . $organization_id);
    die;
}
