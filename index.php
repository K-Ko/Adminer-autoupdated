<?php

extension_loaded('newrelic') && newrelic_set_appname('Adminer');

$config = parse_ini_file('config/config.ini');

function adminer_object() {
    include_once 'plugins/plugin.php';
    include_once 'plugins/json-column.php';
    include_once 'plugins/single-server.php';

    return new AdminerPlugin(array(
        new AdminerJsonColumn,
        new AdminerLoginSingleServer($config['mysql'])
    ));
}

include 'adminer.php';
