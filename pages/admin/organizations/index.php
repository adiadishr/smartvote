<?php
require "../../../config/config.php";
$sql = "SELECT * FROM organizations;";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
    $organizations[] = $row;
}
$title = 'Admin - Manage Organizations';
$css_module = 'admin_dashboard';
$index = false;
$header = 'Organizations';
require getBasePath() . 'includes/header.php';
require '../navbar.php';
?>

<h2><?= $header ?></h2>
<table class="table">
    <thead>
        <tr>
            <th>Id</th>
            <th>Organization</th>
            <th>Organization Code</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $index = 1;
        foreach ($organizations as $organization) {
        ?>
            <tr>
                <td><?= $index ?></td>
                <td><?= $organization['organization'] ?></td>
                <td><?= $organization['code'] ?></td>
                <td>
                    <a href="edit/<?= $organization['id'] ?>">Edit</a>
                    <a href="delete/<?= $organization['id'] ?>">Delete</a>
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