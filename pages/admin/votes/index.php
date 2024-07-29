<?php
require "../../../config/config.php";
$sql = "SELECT *, p.poll, u.username, o.option FROM votes 
JOIN polls p ON votes.poll_id = p.id
JOIN users u ON votes.user_id = u.id
JOIN options o ON votes.option_id = o.id";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
    $votes[] = $row;
}
$title = 'Admin - Manage Votes';
$css_module = 'admin_dashboard';
$index = false;
$header = 'Votes';
require getBasePath() . 'includes/header.php';
require '../navbar.php';
?>

<h2><?= $header ?></h2>
<table class="table">
    <thead>
        <tr>
            <th>Id</th>
            <th>Username</th>
            <th>Poll</th>
            <th>option</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $index = 1;
        foreach ($votes as $vote) {
        ?>
            <tr>
                <td><?= $index ?></td>
                <td><?= $vote['username'] ?></td>
                <td><?= $vote['poll'] ?></td>
                <td><?= $vote['option'] ?></td>
                <td>
                    <a href="edit?id=<?= $vote['id'] ?>">Edit</a>
                    <a href="delete?id=<?= $vote['id'] ?>">Delete</a>
                </td>
            </tr>
        <?php
            $index++;
        }
        ?>
    </tbody>
</table>

<?php
require '../../../includes/footer.php';
?>