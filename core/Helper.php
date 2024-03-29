<?php

namespace Core;

final class Helper
{
    public static function convertToStudlyCaps(string $provided_words): string
    {
        return ucwords(str_replace([" ", "-"], ["", ""], $provided_words));
    }

    public static function convertToCamelCase(string $provided_words): string
    {
        return lcfirst(self::convertToStudlyCaps($provided_words));
    }

    public static function removeQueryStringVariables(string $provided_string): string
    {
        if (!empty($provided_string)) {
            $parts = explode('?', $provided_string, 2);

            if (strpos($parts[0], '=') === false) {
                $provided_string = $parts[0];
            }
        }
        return $provided_string;
    }

    public static function array_keys_exists(array $keys, array $arr): bool
    {
        return !array_diff_key(array_flip($keys), $arr);
    }
    // TODO: proceed with building template loader method
    public static function loadTemplatePart(string $slug, string $name = "", array $args = []): void
    {
    }

    public static function slugToTitle($slug): string
    {
        return ucfirst(
            trim(
                sanitize_text_field(
                    str_replace(["-", "_"], [" ", " "], $slug)
                )
            )
        );
    }
}
