<?php
require "../../../config/config.php";
$sql = "SELECT c.*, o.organization FROM categories c JOIN organizations o ON c.organization_id = o.id ORDER BY o.organization;";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
    $categories[] = $row;
}
$title = 'Admin - Manage Categories';
$css_module = 'admin_dashboard';
$index = false;
$header = 'Categories';
require getBasePath() . 'includes/header.php';
require '../navbar.php';
?>

<h2><?= $header ?></h2>
<table class="table">
    <thead>
        <tr>
            <th>Id</th>
            <th>Category</th>
            <th>Organization</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $index = 1;
        foreach ($categories as $category) {
        ?>
            <tr>
                <td><?= $index ?></td>
                <td><?= $category['category'] ?></td>
                <td><?= $category['organization'] ?></td>
                <td>
                    <a href="edit/<?= $category['id'] ?>">Edit</a>
                    <a href="delete/<?= $category['id'] ?>">Delete</a>
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