<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit811b270acc31792d947d79ac5e24b25b
{
    public static $prefixLengthsPsr4 = array (
        'C' => 
        array (
            'Classes\\' => 8,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Classes\\' => 
        array (
            0 => __DIR__ . '/../..' . '/Classes',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit811b270acc31792d947d79ac5e24b25b::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit811b270acc31792d947d79ac5e24b25b::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit811b270acc31792d947d79ac5e24b25b::$classMap;

        }, null, ClassLoader::class);
    }
}
