<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit4f1a3cf34939350433cf9aae68f0ad97
{
    public static $files = array (
        'a6f2cd0e9d931f37fec25182c361aac5' => __DIR__ . '/..' . '/zeina/elframework/helpers/elframeworkHelpers.php',
    );

    public static $prefixLengthsPsr4 = array (
        'i' => 
        array (
            'illuminates\\' => 12,
        ),
        'E' => 
        array (
            'Elframework\\' => 12,
        ),
        'C' => 
        array (
            'Contracts\\' => 10,
        ),
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'illuminates\\' => 
        array (
            0 => __DIR__ . '/..' . '/zeina/elframework/illuminates',
        ),
        'Elframework\\' => 
        array (
            0 => __DIR__ . '/..' . '/zeina/elframework/framework',
        ),
        'Contracts\\' => 
        array (
            0 => __DIR__ . '/..' . '/zeina/elframework/Contracts',
        ),
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit4f1a3cf34939350433cf9aae68f0ad97::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit4f1a3cf34939350433cf9aae68f0ad97::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit4f1a3cf34939350433cf9aae68f0ad97::$classMap;

        }, null, ClassLoader::class);
    }
}