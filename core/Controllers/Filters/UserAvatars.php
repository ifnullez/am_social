<?php

namespace Core\Controllers\Filters;

use Core\Models\Files\File;
use Core\Traits\Singleton;
use Core\Controllers\Base\Views;

class UserAvatars
{
    use Singleton;

    public File $fileModel;
    public static $allowedMediaFormats = [
        "image/gif",
        "image/avif",
        "image/jpeg",
        "image/png",
        "image/webp"
    ];

    private function __construct()
    {
        $this->fileModel = File::getInstance();

        add_filter("get_avatar_url", [$this, "useLocalUserAvatarsUrl"], 10, 3);
        add_action("show_user_profile", [$this, "profileFields"]);
        add_action("edit_user_profile", [$this, "profileFields"]);
        add_action("personal_options_update", [$this, "saveProfileAvatar"]);
        add_action("edit_user_profile_update", [$this, "saveProfileAvatar"]);
        add_action("wp_ajax_setUploadedAvatarUrl", [$this, "setUploadedAvatarUrl"]);
        add_action("wp_ajax_nopriv_setUploadedAvatarUrl", [$this, "setUploadedAvatarUrl"]);
    }

    public function setUploadedAvatarUrl()
    {
        $user_id = sanitize_text_field($_POST["user_id"]);
        $userAvatarUrl = "{$this->fileModel->uploadDirBaseUrl}/user-avatars/{$user_id}";
        if (!empty($_FILES['avatar']) && !empty($user_id)) {
            $uploaded = $this->fileModel->upload($_FILES['avatar'], "/user-avatars/{$user_id}", true);
        }
        if (!empty($uploaded)) {
            wp_send_json_success([
                "base_url" => $userAvatarUrl,
                "avatar_url" => $uploaded,
                "message" => "avatar succesfully uploaded"
            ]);
        }
        wp_send_json_error([
            "base_url" => $userAvatarUrl,
            "avatar_url" => "",
            "message" => "something go wrong!"
        ]);
    }

    public function profileFields($user)
    {
        $avatarUrl = get_user_meta($user->ID, 'avatar_url', true);
        include Views::getInstance()->templates . "/User/avatar.php";
    }

    public function saveProfileAvatar($user_id)
    {
        if (!isset($_POST['_wpnonce']) || !wp_verify_nonce($_POST['_wpnonce'], 'update-user_' . $user_id)) {
            return;
        }

        if (!current_user_can('edit_user', $user_id)) {
            return;
        }

        update_user_meta($user_id, "avatar_url", sanitize_text_field($_POST["avatar_url"]));
    }

    public function useLocalUserAvatarsUrl($url, $id_or_email, $args)
    {
        $userAvatarUrl = get_user_meta($id_or_email, "avatar_url", true);
        if (filter_var($id_or_email, FILTER_VALIDATE_EMAIL)) {
            $id_or_email = get_user_by('email', $id_or_email);
        }
        if (!empty($userAvatarUrl)) {
            return $userAvatarUrl;
        }
        return $url;
    }
}
