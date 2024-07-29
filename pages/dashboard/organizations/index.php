<?php
require '../../../config/config.php';
require '../../../includes/check_user.php';
require '../../../includes/get_organization_name.php';

// Get active polls
$sql = "SELECT p.*, c.category 
        FROM polls p 
        LEFT JOIN categories c ON p.category_id = c.id 
        LEFT JOIN votes v ON p.id = v.poll_id AND v.user_id = $_SESSION[user_id]
        WHERE p.organization_id = $organization_id AND v.poll_id IS NULL";
$result = mysqli_query($conn, $sql);
$poll_count = $result->num_rows;

// Get notices
$sql = "SELECT * FROM notices WHERE organization_id = $organization_id";
$notice_result = mysqli_query($conn, $sql);
$notice_count = $notice_result->num_rows;

//Statistics
$all_poll_count = mysqli_query($conn, "SELECT * FROM polls WHERE organization_id = $organization_id")->num_rows;
$all_user_count = mysqli_query($conn, "SELECT * FROM users_organizations WHERE organization_id = $organization_id")->num_rows;

//Configuratoin
$title = 'Dashboard - ' . $organization;
require getBasePath() . 'includes/header.php';
?>
<main>
    <h1>Dashboard / <?= $organization ?></h1>
    <a href="../">Back</a><br />
    <h3><?= $organization ?></h3>
    <?php if ($row['user_id'] == $_SESSION['user_id']) { ?>
        <a href="../polls/create.php?organization_id=<?= $organization_id ?>">Create a poll</a><br />
        <a href="../notices/create.php?organization_id=<?= $organization_id ?>">Create a notice</a><br />
        <a href="../categories/?organization_id=<?= $organization_id ?>">Manage Categories</a><br />
    <?php } ?>
    <h3>Statistics</h3>
    <a href="../polls/all_polls.php?organization_id=<?= $organization_id ?>">~Polls:<?= $all_poll_count ?></a><br />
    <a href="../users/all_users.php?organization_id=<?= $organization_id ?>">~Members:<?= $all_user_count ?></a><br />
    <a href="../votes?organization_id=<?= $organization_id ?>">~View Results</a><br />
    <h3>Active Polls</h3>
    <?= $poll_count == 0 ? '<p>There are no more active polls that you can vote on for ' . $organization . '.</p>' : null ?>
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
    <h3>Notices</h3>
    <?= $notice_count == 0 ? '<p>There are no notices for ' . $organization . '.</p>' : null ?>
    <?php
    while ($notices = $notice_result->fetch_assoc()) {
        $notice = $notices['notice'];
        $description = $notices['description'];
    ?>
        <div>
            <a href="../notices/?notice_id=<?= $notices['id'] ?>"><?= $notice ?></a><br />
            <p><?= $description ?></p>
        </div>
        <hr />
    <?php
    }
    ?>
</main>

<?php
require '../../../includes/footer.php';
?>