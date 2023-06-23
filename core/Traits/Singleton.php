<?php
namespace Core\Traits;

trait Singleton
{
    private static $instance;

    public static function getInstance()
    {

        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    private function __construct(){}

    private function __clone(){}

    public function __wakeup()
    {
        throw new \Exception("Cannot unserialize singleton class");
    }
}