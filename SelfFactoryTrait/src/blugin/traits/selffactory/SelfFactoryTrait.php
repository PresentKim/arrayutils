<?php

/*
 *
 *  ____  _             _         _____
 * | __ )| |_   _  __ _(_)_ __   |_   _|__  __ _ _ __ ___
 * |  _ \| | | | |/ _` | | '_ \    | |/ _ \/ _` | '_ ` _ \
 * | |_) | | |_| | (_| | | | | |   | |  __/ (_| | | | | | |
 * |____/|_|\__,_|\__, |_|_| |_|   |_|\___|\__,_|_| |_| |_|
 *                |___/
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the MIT License.
 *
 * @author  Blugin team
 * @link    https://github.com/Blugin
 * @license https://www.gnu.org/licenses/mit MIT License
 *
 *   (\ /)
 *  ( . .) ♥
 *  c(")(")
 */

declare(strict_types=1);

namespace blugin\traits\selffactory;

trait SelfFactoryTrait{
    /** @var self[] */
    protected static $instances = [];

    /** @var mixed|null */
    protected static $defaultKey = null;

    /** @return self[] */
    public static function getAll() : array{
        return self::$instances;
    }

    /** @param mixed $key */
    public static function get($key = null) : ?self{
        return self::$instances[$key] ?? self::$instances[self::$defaultKey] ?? null;
    }

    /** @param mixed $key */
    public static function getClone($key = null) : ?self{
        $instance = self::get($key);
        return $instance === null ? null : clone $instance;
    }

    /** @param mixed $key */
    public static function register($key, self $instance) : void{
        self::$instances[$key] = $instance;
    }

    final public static function registerDefaults() : void{
    }
}