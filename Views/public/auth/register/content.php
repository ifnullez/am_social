<?php get_header();

use Core\Controllers\Base\Views; ?>

<header id="auth-page-header">
    <?php _e( apply_filters( "register_page_title", ""), "ams" ); ?>
</header>

<?php include Views::getInstance()->templates . "/register/register-form.php"; ?>

<?php get_footer(); ?>
