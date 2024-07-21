<?php
require '../../../config/config.php';
$title = 'Create group';
$css_module = 'dashboard';
require getBasePath() . 'includes/header.php';
?>

<h1>Dashboard / Create Group</h1>
<a href="../">Back</a>
<h3>Create a group</h3>
<form action="<?= getBasePath() ?>controllers/organizations/create.php" method="post">
    <div>
        <label for="organization">Group Name:</label>
        <input type="text" name="organization" required>
    </div>
    <!-- <div>
        <label for="description">Description:</label>
        <textarea id="description" name="description" required></textarea>
    </div> -->
    <div>
        <label for="code">Code:</label>
        <input type="password" name="code" required></textarea>
        <p>
            <i>
                This code should be kept private and should not be shared with unauthorized users.<br />
                It will be used to indentify and join your group.<br />
                Don't worry, you can change it later.<br />
            </i>
        </p>
    </div>
    <input type="hidden" name="organization_id" value="<?= $organization_id ?>" />
    <div>
        <input type="submit" value="Create Group" />
    </div>
</form>

<?php
require '../../../includes/footer.php';
?>