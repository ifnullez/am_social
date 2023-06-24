<?php get_header();

use Core\Controllers\Base\Views; ?>

<header id="auth-page-header">
    <?php _e( apply_filters( "login_page_title", ""), "ams" ); ?>
</header>

<?php if(is_user_logged_in()){
    include Views::getInstance()->templates . "/login/logged-in.php";
} else {
    include Views::getInstance()->templates . "/login/login-form.php";
} ?>
<?php get_footer(); ?>
