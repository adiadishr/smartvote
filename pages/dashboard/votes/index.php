<?php
require '../../../config/config.php';
require '../../../includes/check_user.php';
require '../../../includes/get_organization_name.php';

// Ensure organization_id is properly escaped
$organization_id = intval($organization_id);

// Fetch polls along with their categories
$sql = "SELECT p.*, c.category FROM polls p 
        LEFT JOIN categories c ON p.category_id = c.id
        WHERE p.organization_id = $organization_id";
$result = mysqli_query($conn, $sql);
$poll_count = $result->num_rows;

// Configuration 
$title = 'Results - ' . $organization;
require getBasePath() . 'includes/header.php';
?>
<main>
    <h1>Dashboard / <?= htmlspecialchars($organization) ?> / Results</h1>
    <a href="../organizations/?organization_id=<?= $organization_id ?>">Back</a><br />
    <h3><?= htmlspecialchars($organization) ?></h3>
    <div>
        <?php while ($poll = $result->fetch_assoc()) { ?>
            <div>
                <a href="details.php?poll_id=<?= $poll['id'] ?>&organization_id=<?= $organization_id ?>">
                    <h4>Poll Title: <?= htmlspecialchars($poll['poll']) ?></h4>
                </a>
                <p>Category: <?= htmlspecialchars($poll['category']) ?></p>
                <?php
                // Fetch votes count
                $poll_id = intval($poll['id']);
                $vote_sql = "SELECT COUNT(v.id) as vote_count 
                             FROM votes v 
                             WHERE v.poll_id = $poll_id ";
                $vote_result = mysqli_query($conn, $vote_sql);

                // Display the vote results
                echo '<p>Votes: ' . $vote_result->fetch_assoc()['vote_count'] . '</p>';
                ?>
                <hr />
            </div>
        <?php } ?>
    </div>
</main>
<?php
require getBasePath() . 'includes/footer.php';
?>