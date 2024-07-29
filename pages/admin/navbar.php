<?php
$backtick = null;
if ($index == false) {
    $backtick = '../';
}
?>
<h1>Admin Dashboard <?= $header ? '/ ' . $header : null ?></h1>
<a href="<?= !$index ? '../' : '../../' . $backtick ?>"><?= !$index ? 'Back' : 'Home' ?></a>
<a href="../../<?= $backtick ?>controllers/auth/logout.php">Logout</a>
<br />
<a href="<?= $backtick ?>users">Manage Users</a>
<a href="<?= $backtick ?>organizations">Manage Organizations</a>
<a href="<?= $backtick ?>categories">Manage Categories</a>
<a href="<?= $backtick ?>polls">Manage Polls</a>
<a href="<?= $backtick ?>votes">Manage Votes</a>
<?= $index ? '<p>Welcome ' . $_SESSION['username'] . '</p>' : null ?>