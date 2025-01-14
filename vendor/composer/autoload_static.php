<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitb67069299594d83a0dec907ca15270fd
{
    public static $prefixLengthsPsr4 = array (
        'R' => 
        array (
            'Ryzer\\Vaga\\' => 11,
        ),
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Ryzer\\Vaga\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src/app',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitb67069299594d83a0dec907ca15270fd::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitb67069299594d83a0dec907ca15270fd::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitb67069299594d83a0dec907ca15270fd::$classMap;

        }, null, ClassLoader::class);
    }
}
