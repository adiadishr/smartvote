<?php
$title = 'Dashboard';
$css_module = 'dashboard';
require '../../config/config.php';
$user_id = $_SESSION['user_id'];
$sql = "SELECT uo.*, o.organization FROM users_organizations uo LEFT JOIN organizations o ON uo.organization_id = o.id WHERE uo.user_id = $user_id";
$result = mysqli_query($conn, $sql);
$organizations = array();
while ($row = $result->fetch_assoc()) {
    $organizations[] = $row;
}
require getBasePath() . 'includes/header.php';
?>

<h1>Dashboard</h1>
<a href="../../">Home</a>
<a href="../../controllers/auth/logout.php">Logout</a>
<h3>Welcome <?= $_SESSION['username'] ?></h3>
<a href="organizations/join.php">Join an existing group</a><br />
<a href="organizations/create.php">Create a new group</a><br />
<h3>Groups:</h3>
<?php if (empty($organizations)) {
    echo '<p>You are not a part of any organizations</p>';
} else {
    foreach ($organizations as $organization) { ?>
        <a href="organizations/?organization_id=<?= $organization['organization_id'] ?>"><?= $organization['organization'] ?></a><br />
<?php }
}  ?>
<?php
require '../../includes/footer.php';
?>