<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit65405dbc836a547c4777d60a29ef5302
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PSMMW\\' => 6,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PSMMW\\' => 
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
            $loader->prefixLengthsPsr4 = ComposerStaticInit65405dbc836a547c4777d60a29ef5302::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit65405dbc836a547c4777d60a29ef5302::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit65405dbc836a547c4777d60a29ef5302::$classMap;

        }, null, ClassLoader::class);
    }
}