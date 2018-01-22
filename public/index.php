<?php

if (!file_exists('../.verbose')) {
    // Quiet
    ini_set('display_errors', 0);
    error_reporting(0);
} else {
    // Quiet
    ini_set('display_errors', 1);
    error_reporting(-1);
}

extension_loaded('newrelic') && newrelic_set_appname('Adminer');

$cfg = '../config/config.ini';

if (!file_exists($cfg)) {
    die('Missing configuration file!');
}

$config = parse_ini_file($cfg);

if (!file_exists('../adminer.php')) {
    // Load inital
    exec('../bin/update.sh');
    die('<html><head><meta http-equiv="refresh" content="0"></head>' . 
        '<body></body></html>');
}

/**
 * Wrapper function
 */
function adminer_object()
{
    global $config;

    // Plugins auto-loader
    foreach (glob('../plugins/*.php') as $filename) {
        include_once $filename;
    }

    $plugins = array(
        new AdminerLoginSingleServer($config['mysql']),
        new AdminerJsonColumn,
//         new AdminerFloatThead,
//         new AdminerTablesHistory
    );

    if (isset($config['theme'])) {
        $plugins[] = new AdminerTheme($config['theme']);
    }

    return new AdminerPlugin($plugins);
}

include '../adminer.php';
