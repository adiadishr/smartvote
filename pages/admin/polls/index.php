<?php
require "../../../config/config.php";
$sql = "SELECT p.*, c.category, o.organization, op.Count as option_count
        FROM polls p 
        LEFT JOIN categories c ON p.category_id = c.id 
        LEFT JOIN organizations o ON p.organization_id = o.id 
        LEFT JOIN (SELECT poll_id, COUNT(*) as Count FROM options GROUP BY poll_id) op ON op.poll_id = p.id
        ORDER BY o.organization;";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
    $polls[] = $row;
}
$title = 'Admin - Manage Polls';
$index = false;
$css_module = 'admin_dashboard';
$header = 'Polls';
require getBasePath() . 'includes/header.php';
require '../navbar.php';
?>
<h2><?= $header ?></h2>
<table class="table">
    <thead>
        <tr>
            <th>Id</th>
            <th>Poll Title</th>
            <th>Description</th>
            <th>Category</th>
            <th>Organization</th>
            <th>Options</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $index = 1;
        foreach ($polls as $poll) {
        ?>
            <tr>
                <td><?= $index ?></td>
                <td><?= $poll['poll'] ?></td>
                <td><?= $poll['description'] ?></td>
                <td><?= $poll['category'] ?></td>
                <td><?= $poll['organization'] ?></td>
                <td><?= $poll['option_count'] ?></td>
                <td>
                    <a href="edit/<?= $poll['id'] ?>">Edit</a>
                    <a href="delete/<?= $poll['id'] ?>">Delete</a>
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