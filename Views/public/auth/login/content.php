<?php get_header();

use Core\Controllers\Base\Views; ?>

<main id="ams-main">
    <?php if (is_user_logged_in()) {
        include Views::getInstance()->templates . "/login/logged-in.php";
    } else {
        include Views::getInstance()->templates . "/login/login-form.php";
    } ?>
</main>
<?php get_footer(); ?>