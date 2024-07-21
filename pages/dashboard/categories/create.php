<?php
require '../../../config/config.php';
$organization_id = $_GET['organization_id'];
$check = "SELECT uo.*, o.organization FROM users_organizations uo LEFT JOIN organizations o ON uo.organization_id = o.id WHERE uo.organization_id = $organization_id AND uo.user_id = $_SESSION[user_id]";
$result = mysqli_query($conn, $check);
if ($result->num_rows == 0) {
    $_SESSION['error'] = 'You are not a part of this organization';
    header("Location: ../");
    die;
}
$organization = $result->fetch_assoc()['organization'];
$title = 'Create category' . ' - ' . $organization;
require getBasePath() . 'includes/header.php';
?>

<h1>Dashboard / <?= $organization ?> / Categories / Create a category</h1>
<a href="../categories/?organization_id=<?= $organization_id ?>">Back</a>
<h3><?= $organization ?></h3>
<form action="<?= getBasePath() ?>controllers/categories/create.php" method="post">
    <label for="category">Category:</label>
    <input type="text" name="category" id="category" />
    <input type="hidden" name="organization_id" value="<?= $organization_id ?>" />
    <button type="submit">Create</button>
</form>

<?php
require '../../../includes/footer.php';
?>