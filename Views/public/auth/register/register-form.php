<?php do_action("ams_before_register_form"); ?>
<form id="ams-register" name="ams-register" method="post" novalidate>
    <input type="text" name="user_email" placeholder="E-mail">
    <input type="password" name="user_pass" placeholder="Password">
    <button type="submit"><?php _e("Register", "ams"); ?></button>
</form>
<?php do_action("ams_after_register_form"); ?>
