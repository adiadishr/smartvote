<?php
require '../../../config/config.php';
//check if the poll's organization is the user's organization
$poll_id = $_GET['poll_id'];
$sql = "SELECT p.*, c.category, o.organization 
        FROM polls p 
        LEFT JOIN categories c ON p.category_id = c.id 
        LEFT JOIN organizations o ON p.organization_id = o.id 
        WHERE p.id = $poll_id";
$result = mysqli_query($conn, $sql);
if ($result->num_rows == 0) {
    $_SESSION['error'] = 'Poll does not exist';
    header("Location: ../");
    die;
}
$poll = $result->fetch_assoc();
$organization_id = $poll['organization_id'];
$poll_title = $poll['poll'];
$organization = $poll['organization'];
$category = $poll['category'];
$check = "SELECT * FROM users_organizations WHERE organization_id = $organization_id AND user_id = $_SESSION[user_id]";
$result = mysqli_query($conn, $check);
if ($result->num_rows == 0) {
    $_SESSION['error'] = 'Invalid request - you do not have permission to view this poll.';
    header("Location: ../");
    die;
}
$option_sql = "SELECT * FROM options WHERE poll_id = $poll_id";
$option_result = mysqli_query($conn, $option_sql);
$title = 'Poll' . ' - ' . $organization . ' - ' . $category;
require getBasePath() . 'includes/header.php';
?>
<main>
    <h1>Dashboard / <?= $organization ?> / Polls / Details </h1>
    <a href="../organizations/?organization_id=<?= $organization_id ?>">Back</a><br />
    <h3><?= $organization ?></h3>
    <a href="edit.php?poll_id=<?= $poll_id ?>">Edit Poll</a><br /><br />
    <h3><?= $poll_title ?></h3>
    <p>Category:<?= $category ?></p>
    <p><i>~<?= $poll['description'] ?></i></p><br />
    <form action="vote.php" method="post">
        <?php
        while ($options = $option_result->fetch_assoc()) {
        ?>
            <input type="radio" name="option_id" value="<?= $options['id'] ?>"><?= $options['option'] ?><br />
        <?php
        }
        ?><br />
        <input type="submit" value="Submit Vote">
    </form>
</main>

<?php
require '../../../includes/footer.php';
?>