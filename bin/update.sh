#!/bin/bash

## set -x

## Find base path also if script was linked
path=$(dirname $(dirname $(readlink -f $0)))

cfg=$path/config/config.ini

[ ! -s $cfg ] && echo 'Missing configuration file!' && exit 1

### Get config
. $cfg

### Temp file for download
new=$(mktemp)
trap "rm $new >/dev/null 2>&1" 0

### Fetch latest Adminer for MySQL only
wget -qO $new http://www.adminer.org/$version

### Check if the download was successful
### (sometimes the downlaoded file is empty, I think it happens on timeouts)
if [ -s $new ]; then

    ### Change attributes and owner to the same as index.php
    chmod --reference=$path/index.php $new
    chown --reference=$path/index.php $new

    ### Move the just downloaded file to its correct name
    mv $new $path/adminer.php

fi
