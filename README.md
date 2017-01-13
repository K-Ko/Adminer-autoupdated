# Adminer-autoupdated

Adminer installation with auto-update script

## Clone this repo into your document root

    git clone https://github.com/K-Ko/Adminer-autoupdated.git /var/www/html

## Copy configuration template

    cp config/config.conf.dist config/config.conf

## Review and adjust the configuration as needed

    $EDITOR config/config.conf

## Add the auto-update script to the cron tab of your web server user, mostly `www-data`

    # Run every morning at 6 AM
    0 6 * * * /path/to/adminer-web/bin/update.sh

## Or create a link to run daily

    sudo ln -s /path/to/adminer-web/bin/update.sh /etc/cron.daily/update-adminer

## Design

In this repo is a cleaner `adminer.css` included.

You can replace it with any other design from [Adminer homepage](https://www.adminer.org/#extras)
