<?php
require '../../../config/config.php';
require '../../../includes/check_user.php';
require '../../../includes/get_organization_name.php';

// Get keys and sanitize
$organization_id = intval($organization_id);
$poll_id = intval($_GET['poll_id']);

// Get poll details
$sql = "SELECT p.*, c.category FROM polls p 
        LEFT JOIN categories c ON p.category_id = c.id
        WHERE p.id = $poll_id";
$result = mysqli_query($conn, $sql);
$poll = $result->fetch_assoc();

//Get votes and options
$vote_sql = "SELECT o.option, COUNT(v.id) as vote_count 
            FROM options o 
            LEFT JOIN votes v ON o.id = v.option_id 
            WHERE o.poll_id = $poll_id 
            GROUP BY o.id";
$vote_result = mysqli_query($conn, $vote_sql);

//Configuration
$title = 'Results - ' . $organization . ' - Poll #' . $poll_id;
require getBasePath() . 'includes/header.php';
?>
<main>
    <h1>Dashboard / <?= $organization ?> / Results / Details - Poll#<?= $poll_id ?></h1>
    <a href="../votes/?organization_id=<?= $organization_id ?>">Back</a><br />
    <h3><?= $organization ?></h3>
    <h4>Poll Title: <?= htmlspecialchars($poll['poll']) ?></h4>
    <p>Category: <?= htmlspecialchars($poll['category']) ?></p>
    <p><b>Results</b></p>
    <?php
    $index = 1;
    while ($vote = $vote_result->fetch_assoc()) {
    ?>
        <p><?= $index ?>) <?= htmlspecialchars($vote['option']) ?>: <?= $vote['vote_count'] ?></p>
    <?php
        $index++;
    }
    ?>
</main>

<?php
require '../../../includes/footer.php';
?>