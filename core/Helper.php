<?php
namespace Core;

final class Helper
{
    public static function convertToStudlyCaps(string $provided_words ): string
    {
        return ucwords( str_replace([" ", "-"], ["", ""], $provided_words ) );
    }

    public static function convertToCamelCase( string $provided_words ): string
    {
        return lcfirst( self::convertToStudlyCaps( $provided_words ) );
    }

    public static function removeQueryStringVariables( string $provided_string ): string
    {
        if( !empty( $provided_string ) ) {
            $parts = explode( '?', $provided_string, 2 );

            if( strpos( $parts[0], '=' ) === false ) {
                $provided_string = $parts[0];
            }
        }
        return $provided_string;
    }

    public static function array_keys_exists(array $keys, array $arr): bool
    {
        return !array_diff_key(array_flip($keys), $arr);
    }
}