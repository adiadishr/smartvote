<?php
require '../../../config/config.php';
$organization_id = $_GET['organization_id'];
$check = "SELECT uo.*, o.organization FROM users_organizations uo LEFT JOIN organizations o ON uo.organization_id = o.id WHERE uo.organization_id = $organization_id AND uo.user_id = $_SESSION[user_id]";
$result = mysqli_query($conn, $check);
if ($result->num_rows == 0) {
    $_SESSION['error'] = 'You are not a part of this organization';
    header("Location: ../");
    die;
}
$organization = $result->fetch_assoc()['organization'];
$sql = "SELECT * FROM categories WHERE organization_id = $organization_id";
$result = mysqli_query($conn, $sql);
$title = 'Categories' . ' - ' . $organization;
require getBasePath() . 'includes/header.php';
?>
<main>
    <h1>Dashboard / <?= $organization ?> / Categories</h1>
    <a href="../organizations/?organization_id=<?= $organization_id ?>">Back</a><br />
    <h3><?= $organization ?></h3>
    <a href="create.php?organization_id=<?= $organization_id ?>">Create a category</a><br />
    <table>

        <tbody>
            <?php
            if ($result->num_rows > 0) {
            ?>
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Category</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <?php
                $index = 1;
                while ($category = $result->fetch_assoc()) {
                ?>
                    <tr>
                        <td><?= $index ?></td>
                        <td><?= $category['category'] ?></td>
                        <td>
                            <a href="../categories/edit/<?= $category['id'] ?>">Edit</a>
                            <a href="../categories/delete/<?= $category['id'] ?>">Delete</a>
                        </td>
                    </tr>
            <?php
                    $index++;
                }
            } else {
                echo '<p>There are no categories for this organization.</p>';
            }
            ?>
    </table>
</main>

<?php
require '../../../includes/footer.php';
?>