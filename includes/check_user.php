<?php
// Check if the user is a part of the organization
$organization_id = $_GET['organization_id'];
$check = "SELECT * FROM users_organizations WHERE organization_id = $organization_id AND user_id = $_SESSION[user_id]";
$result = mysqli_query($conn, $check);
if ($result->num_rows == 0) {
    $_SESSION['error'] = 'You are not a part of this organization';
    header("Location: ../");
    die;
}
