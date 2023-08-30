<?php

use Core\Controllers\Filters\UserAvatars;
?>
<!-- <button type="button" class="button" id="change_avatar"><?php _e("Change avatar", "ams"); ?></button> -->
<div id="profile-avatar-picker" class="profile-avatar-picker hidden">
    <div class="profile-avatar-picker--modal">
        <span class="profile-avatar-picker--modal--close">&#10006;</span>
        <label for="profile_avatar" class="profile-avatar-picker--modal--dropzone">
            <span class="profile_avatar_message">Click the area or Drop the file please!</span>
            <input type="file" name="profile_avatar" id="profile_avatar" accept="<?php echo implode(", ", UserAvatars::$allowedMediaFormats); ?>">
        </label>
    </div>
</div>
<input type="hidden" name="avatar_url" id="avatar_url" value="<?php echo esc_url($avatarUrl); ?>" />