<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit3c08aac3b2e365e7abbbcbc0991d8499
{
    public static $prefixLengthsPsr4 = array (
        'M' => 
        array (
            'MF\\' => 3,
        ),
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'MF\\' => 
        array (
            0 => __DIR__ . '/..' . '/MF',
        ),
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/App',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit3c08aac3b2e365e7abbbcbc0991d8499::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit3c08aac3b2e365e7abbbcbc0991d8499::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit3c08aac3b2e365e7abbbcbc0991d8499::$classMap;

        }, null, ClassLoader::class);
    }
}
