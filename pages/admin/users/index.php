<?php
require "../../../config/config.php";
$sql = "SELECT *, r.role FROM users JOIN  roles r ON  users.role_id = r.id; ";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
    $users[] = $row;
}
$title = 'Admin - Manage Users';
$css_module = 'admin_dashboard';
$index = false;
$header = 'Users';
require getBasePath() . 'includes/header.php';
require '../navbar.php';
?>

<h2><?= $header ?></h2>
<table class="table">
    <thead>
        <tr>
            <th>Id</th>
            <th>Username</th>
            <th>Role</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $index = 1;
        foreach ($users as $user) {
        ?>
            <tr>
                <td><?= $index ?></td>
                <td><?= $user['username'] ?></td>
                <td><?= $user['role'] ?></td>
                <td>
                    <a href="edit/<?= $user['id'] ?>">Edit</a>
                    <a href="delete/<?= $user['id'] ?>">Delete</a>
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