<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit3134e1cad71ae9087c5445cc49443cff
{
    public static $prefixLengthsPsr4 = array (
        'N' => 
        array (
            'NikitaFeedBackPlugin\\' => 21,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'NikitaFeedBackPlugin\\' => 
        array (
            0 => __DIR__ . '/../..' . '/classes',
        ),
    );

    public static $classMap = array (
        'NikitaFeedBackPlugin\\View\\Enqueue' => __DIR__ . '/../..' . '/classes/View/Enqueue.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit3134e1cad71ae9087c5445cc49443cff::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit3134e1cad71ae9087c5445cc49443cff::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit3134e1cad71ae9087c5445cc49443cff::$classMap;

        }, null, ClassLoader::class);
    }
}