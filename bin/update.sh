#!/bin/bash

## set -x

## Find base path also if script was linked
path=$(dirname $(dirname $(readlink -f $0)))

cfg=$path/config/config.ini

[ ! -s $cfg ] && echo 'Missing configuration file!' && exit 1

### Get config, transform from PHP ini to shell
eval $(grep -v '^;' $cfg | sed 's/ *\(=\) */\1/g')

### Temp file for download
new=$(mktemp)
trap 'rm $new >/dev/null &>/dev/null' 0

cd $path

### Fetch latest Adminer for MySQL only
wget -qO $new http://www.adminer.org/$version

### Check if the download was successful
### (sometimes the downlaoded file is empty, I think it happens on timeouts)
if [ -s $new ]; then
    ### Move the just downloaded file to its correct name
    mv $new adminer.php

    ### Change attributes and owner to the same as index.php
    chmod --reference=index.php adminer.php
    chown --reference=index.php adminer.php
fi

### Update sub modules
git submodule init
git submodule update

### Update adminer-theme
p=$path/contrib/adminer-theme/lib

[ -L $path/public/css ] || ln -sf $p/css    $path/public/css
[ -L $path/public/fonts ] || ln -sf $p/fonts  $path/public/fonts
[ -L $path/public/images ] || ln -sf $p/images $path/public/images
[ -L $path/plugins/AdminerTheme.php ] || ln -sf $p/plugins/AdminerTheme.php $path/plugins/AdminerTheme.php
