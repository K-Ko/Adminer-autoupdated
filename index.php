<?php

extension_loaded('newrelic') && newrelic_set_appname('Adminer');

$cfg = 'config/config.ini';

if (!file_exists($cfg))  die('Missing configuration file!');

$config = parse_ini_file($cfg);

function adminer_object() {
    include_once 'plugins/plugin.php';
    include_once 'plugins/json-column.php';
    include_once 'plugins/single-server.php';

    global $config;

    return new AdminerPlugin(array(
        new AdminerJsonColumn,
        new AdminerLoginSingleServer($config['mysql'])
    ));
}

include 'adminer.php';
