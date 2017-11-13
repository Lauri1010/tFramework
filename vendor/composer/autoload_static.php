<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit533117f4f826e3fe321ffbb3126f923f
{
    public static $prefixLengthsPsr4 = array (
        'I' => 
        array (
            'Interop\\Container\\' => 18,
        ),
        'A' => 
        array (
            'Aura\\Web\\_Config\\' => 17,
            'Aura\\Web\\' => 9,
            'Aura\\Session\\_Config\\' => 21,
            'Aura\\Session\\' => 13,
            'Aura\\Di\\' => 8,
            'Aura\\Auth\\_Config\\' => 18,
            'Aura\\Auth\\' => 10,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Interop\\Container\\' => 
        array (
            0 => __DIR__ . '/..' . '/container-interop/container-interop/src/Interop/Container',
        ),
        'Aura\\Web\\_Config\\' => 
        array (
            0 => __DIR__ . '/..' . '/aura/web/config',
        ),
        'Aura\\Web\\' => 
        array (
            0 => __DIR__ . '/..' . '/aura/web/src',
        ),
        'Aura\\Session\\_Config\\' => 
        array (
            0 => __DIR__ . '/..' . '/aura/session/config',
        ),
        'Aura\\Session\\' => 
        array (
            0 => __DIR__ . '/..' . '/aura/session/src',
        ),
        'Aura\\Di\\' => 
        array (
            0 => __DIR__ . '/..' . '/aura/di/src',
        ),
        'Aura\\Auth\\_Config\\' => 
        array (
            0 => __DIR__ . '/..' . '/aura/auth/config',
        ),
        'Aura\\Auth\\' => 
        array (
            0 => __DIR__ . '/..' . '/aura/auth/src',
        ),
    );

    public static $fallbackDirsPsr0 = array (
        0 => __DIR__ . '/..' . '/cheprasov/php-simple-profiler/src',
    );

    public static $classMap = array (
        'Console_Table' => __DIR__ . '/..' . '/pear/console_table/Table.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit533117f4f826e3fe321ffbb3126f923f::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit533117f4f826e3fe321ffbb3126f923f::$prefixDirsPsr4;
            $loader->fallbackDirsPsr0 = ComposerStaticInit533117f4f826e3fe321ffbb3126f923f::$fallbackDirsPsr0;
            $loader->classMap = ComposerStaticInit533117f4f826e3fe321ffbb3126f923f::$classMap;

        }, null, ClassLoader::class);
    }
}
