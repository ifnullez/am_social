<?php

namespace Core\Models\Files;

use Core\Traits\Singleton;

class File
{
    use Singleton;

    public string $uploadDirBaseUrl;
    public string $uploadDirBaseDir;

    private function __construct()
    {
        $this->uploadDirBaseUrl = wp_get_upload_dir()["baseurl"];
        $this->uploadDirBaseDir = wp_get_upload_dir()["basedir"];
    }

    public function upload($file, string $uploadToPath = "", bool $deleteOldOnUpload = false): ?string
    {
        $uploadsPath = !empty($uploadToPath) ? "{$this->uploadDirBaseDir}{$uploadToPath}" : $this->uploadDirBaseUrl;

        if (!is_dir($uploadsPath)) {
            mkdir($uploadsPath, 0755, true);
        } else if ($deleteOldOnUpload) {
            self::_deleteDirAndContent($uploadsPath);
            mkdir($uploadsPath, 0755, true);
        }
        if (!empty($file)) {
            $extension = end(explode(".", $file["name"]));
            // TODO: refactor this to prevent all files be named as AVATAR
            // TODO: Add file validations
            $fileToUpload = "{$uploadsPath}/avatar.{$extension}";
            $fileToUploadUrl = "{$this->uploadDirBaseUrl}{$uploadToPath}/avatar.{$extension}";
            $uploadFile = move_uploaded_file($file["tmp_name"], $fileToUpload);
            if ($uploadFile) {
                return $fileToUploadUrl;
            }
        }
    }

    public static function _deleteDirAndContent(string $dir): bool
    {
        if (is_dir($dir)) {
            $objects = scandir($dir);
            foreach ($objects as $object) {
                if ($object != "." && $object != "..") {
                    if (is_dir($dir . DIRECTORY_SEPARATOR . $object) && !is_link($dir . "/" . $object)) {
                        self::_deleteDirAndContent($dir . DIRECTORY_SEPARATOR . $object);
                    } else {
                        unlink($dir . DIRECTORY_SEPARATOR . $object);
                    }
                }
            }
            rmdir($dir);
            return true;
        }
        return false;
    }
}
