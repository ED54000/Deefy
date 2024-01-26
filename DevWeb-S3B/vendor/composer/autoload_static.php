<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit53556bd7832a1fe60367fd6fb6b099c4
{
    public static $prefixLengthsPsr4 = array (
        'i' => 
        array (
            'iutnc\\deefy\\' => 12,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'iutnc\\deefy\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src/classes',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit53556bd7832a1fe60367fd6fb6b099c4::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit53556bd7832a1fe60367fd6fb6b099c4::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit53556bd7832a1fe60367fd6fb6b099c4::$classMap;

        }, null, ClassLoader::class);
    }
}
