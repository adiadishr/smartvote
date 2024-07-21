<?php
$title = 'SmartVote';
$css_module = 'index';
require 'config/config.php';
require 'includes/header.php';
?>

<main>
    <section class="hero">
        <h1>Welcome to SmartVote!</h1>
        <p>Your opinion matters. Join the conversation and make your voice heard through our simple and intuitive
            polling platform.</p>
        <?php
        if (!isset($_SESSION['username'])) {
        ?>
            <a href="pages/auth/login.php">Login</a>
            <a href="pages/auth/register.php">Register</a>
        <?php } else if (isset($_SESSION['username'])) { ?>
            <?= $_SESSION['role'] == 2 ? '<a href="pages/dashboard">Dashboard</a>' : null ?>
            <?php
            if ($_SESSION['role'] == 1) {
            ?>
                <a href="pages/admin">Admin Dashboard</a>
            <?php } ?>
        <?php } ?>
    </section>
</main>

<?php
require 'includes/footer.php';
?>