<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitff0810c3a46bf49720a837a33840d30c
{
    public static $prefixLengthsPsr4 = array (
        'T' => 
        array (
            'Twitch\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Twitch\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitff0810c3a46bf49720a837a33840d30c::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitff0810c3a46bf49720a837a33840d30c::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitff0810c3a46bf49720a837a33840d30c::$classMap;

        }, null, ClassLoader::class);
    }
}
