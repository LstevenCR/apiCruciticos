<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitfd256b545cd41cf22c1ba8344c45f1e6
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'Psr\\Log\\' => 8,
        ),
        'F' => 
        array (
            'Firebase\\JWT\\' => 13,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Psr\\Log\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/log/src',
        ),
        'Firebase\\JWT\\' => 
        array (
            0 => __DIR__ . '/..' . '/firebase/php-jwt/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitfd256b545cd41cf22c1ba8344c45f1e6::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitfd256b545cd41cf22c1ba8344c45f1e6::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitfd256b545cd41cf22c1ba8344c45f1e6::$classMap;

        }, null, ClassLoader::class);
    }
}
