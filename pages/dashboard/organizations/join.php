<?php
$title = 'Dashboard';
$css_module = 'dashboard';
require '../../../config/config.php';
require getBasePath() . 'includes/header.php';
?>
<h1>Dashboard / Join Group</h1>
<a href="..">Back</a>
<form action="<?= getBasePath() ?>controllers/organizations/join.php" method="post">
    <input type="text" name="organization" id="organization" placeholder="Enter the code for your organization" required>
    <input type="submit" value="Join">
</form>
<?php
require '../../../includes/footer.php';
?>