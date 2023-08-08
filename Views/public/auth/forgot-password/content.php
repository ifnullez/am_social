<?php
use Core\Controllers\Base\Views;

get_header(); ?>
<main id="ams-main">
 <?php include Views::getInstance()->templates . "/forgot-password/forgot-form.php"; ?>
</main>
<?php get_footer(); ?>
