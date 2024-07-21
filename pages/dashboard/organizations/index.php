<?php
require '../../../config/config.php';
$organization_id = $_GET['organization_id'];
$check = "SELECT * FROM users_organizations WHERE organization_id = $organization_id AND user_id = $_SESSION[user_id]";
$result = mysqli_query($conn, $check);
if ($result->num_rows == 0) {
    $_SESSION['error'] = 'You are not a part of this organization';
    header("Location: ../");
    die;
}
$sql = "SELECT * FROM organizations WHERE id = $organization_id";
$result = mysqli_query($conn, $sql);
$row = $result->fetch_assoc();
$organization = $row['organization'];
$sql = "SELECT p.*, c.category FROM polls p LEFT JOIN categories c ON p.category_id = c.id WHERE p.organization_id = $organization_id";
$result = mysqli_query($conn, $sql);
$poll_count = $result->num_rows;
$title = 'Dashboard - ' . $organization;
require getBasePath() . 'includes/header.php';
?>
<main>
    <h1>Dashboard / <?= $organization ?></h1>
    <a href="../">Back</a><br />
    <h3><?= $organization ?></h3>
    <?php if ($row['user_id'] == $_SESSION['user_id']) { ?>
        <a href="../polls/create.php?organization_id=<?= $organization_id ?>">Create a poll</a><br />
        <a href="../categories/?organization_id=<?= $organization_id ?>">Manage Categories</a><br />
    <?php } ?>
    <h3>Polls</h3>
    <?= $poll_count == 0 ? '<p>There are no polls for ' . $organization . '.</p>' : null ?>
    <?php
    while ($polls = $result->fetch_assoc()) {
        $poll = $polls['poll'];
        $description = $polls['description'];
        $category = $polls['category'];
    ?>
        <div>
            <a href="../polls/?poll_id=<?= $polls['id'] ?>"><?= $poll ?></a><br />
            <p><?= $description ?></p>
            <p>Category: <?= $category ?></p>
        </div>
        <hr />
    <?php
    }
    ?>
</main>

<?php
require '../../../includes/footer.php';
?>