<header id="auth-page-header">
    <?php _e(apply_filters("login_page_title", "Logged In as:"), "ams"); ?>
</header>
<div class="user-card user-card--signed">
    <a href="/dashboard">
        <img src="<?php echo get_avatar_url($user->ID); ?>" alt="<?php echo $user->display_name; ?>" />
    </a>
    <div class="user-card--footer">
        <span><?php echo !empty($user->first_name) || !empty($user->last_name) ? "{$user->first_name} {$user->last_name}" : $user->display_name; ?></span>
        <a href="<?php echo wp_logout_url(); ?>" class="btn">LogOut</a>
    </div>
</div>