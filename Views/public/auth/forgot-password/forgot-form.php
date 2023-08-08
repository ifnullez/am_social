<header id="auth-page-header">
    <?php _e(apply_filters("forgot_pass_page_title", "Forgont Password"), "ams"); ?>
</header>
<form id="ams-forgot-pass" method="post">
    <input type="email" id="ams-forgot-email" placeholder="Email">
    <button type="submit" name="ams-forgot-pass-submit" id="ams-forgot-button"><?php _e("Send me link", "ams"); ?></button>
</form>