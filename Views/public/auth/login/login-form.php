<?php do_action("ams_before_login_form"); ?>
<form id="ams-auth" name="ams-auth" method="post" novalidate>
    <input type="text" name="user_name_email" placeholder="Login/E-mail">
    <input type="password" name="user_pass" placeholder="Password">
    <div class="ams-auth-footer">
        <div class="ams-auth-footer-actions">
            <span class="ams-auth-footer-actions--register">
                <a href="/register">
                    <?php _e("SignUp", "ams"); ?>
                </a>
            </span>
            <span class="ams-auth-footer-actions--forgot">
                <a href="/forgot-password">
                    <?php _e("Forgot Password", "ams"); ?>
                </a>
            </span>
        </div>
        <span>
            <input type="checkbox" id="remember_me" name="remember_me">
            <label for="remember_me">Remember Me</label>
        </span>
        <button type="submit"><?php _e("Login", "ams"); ?></button>
    </div>
</form>
<?php do_action("ams_after_login_form"); ?>
