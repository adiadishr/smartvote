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
$category_check = "SELECT * FROM categories WHERE organization_id = $organization_id";
$category_result = mysqli_query($conn, $category_check);
$category_count = $category_result->num_rows;
$organization = $result->fetch_assoc()['organization'];
$title = 'Create poll' . ' - ' . $organization;
require getBasePath() . 'includes/header.php';
?>

<h1>Dashboard / <?= $organization ?> / Polls / Create a poll</h1>
<a href="../organizations/?organization_id=<?= $organization_id ?>">Back</a>
<h3><?= $organization ?></h3>
<?php if ($category_count == 0) {
    echo '<p>You must create a category before creating a poll</p>';
    die;
}
?>
<form action="<?= getBasePath() ?>controllers/polls/create.php" method="post">
    <div>
        <label for="poll">Title:</label>
        <input type="text" name="poll" required>
    </div>
    <div>
        <label for="description">Description:</label>
        <textarea id="description" name="description" required></textarea>
    </div>
    <div>
        <label for="category">Category:</label>
        <select id="category" name="category_id" required>
            <?php
            $sql = "SELECT id, category FROM categories WHERE organization_id = $organization_id";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<option value=" . $row['id'] . ">" . $row['category'] . "</option>";
                }
            }
            ?>
        </select><br />
        <div id="options">
            <label>Options:</label>
            <div>
                <input type="text" name="options[]" placeholder="Option" required>
            </div>
            <div>
                <input type="text" name="options[]" placeholder="Option" required>
            </div>
        </div>
        <button type="button" onclick="addOption()">Add Option</button><br />
        <input type="hidden" name="organization_id" value="<?= $organization_id ?>" />
        <input type="submit" value="Create Poll" />
</form>
<script>
    var optionsDiv = document.getElementById('options');

    function addOption() {
        var newOptionDiv = document.createElement('div');
        newOptionDiv.innerHTML = '<input type="text" name="options[]" placeholder="Option" required /><button type="button" onclick="deleteOption(this)">Delete</button>';
        optionsDiv.appendChild(newOptionDiv);
    }

    function deleteOption(button) {
        if (optionsDiv.childElementCount > 2) {
            optionsDiv.removeChild(button.parentNode);
        } else {
            alert("A poll must have at least two options.");
        }
    }
</script>

<?php
require '../../../includes/footer.php';
?>