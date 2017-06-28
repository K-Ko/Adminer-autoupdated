<?php

extension_loaded('newrelic') && newrelic_set_appname('Adminer');

$cfg = 'config/config.ini';

if (!file_exists($cfg))  die('Missing configuration file!');

$config = parse_ini_file($cfg);

function adminer_object()
{
    // Plugins auto-loader
    foreach (glob("plugins/*.php") as $filename) {
        include_once $filename;
    }

    global $config;

    $plugins = [
        new AdminerLoginSingleServer($config['mysql']),
        new AdminerJsonColumn
    ];
    if (isset($config['theme'])) {
        $plugins[] = new AdminerTheme($config['theme']);
    }
    return new AdminerPlugin($plugins);
}

include 'adminer.php';
