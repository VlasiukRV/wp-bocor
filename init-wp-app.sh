#!/bin/bash
_os="`uname`"
_now=$(date +"%m_%d_%Y")
_file="wp-data/data_$_now.sql"

# Export dump
INSTALL_WP_COMMAND='wp core install --path="/var/www/html" --url="http://$WORDPRESS_IP:$WORDPRESS_PORT" --title="$WORDPRESS_SITE_TITLE" --admin_user=$WORDPRESS_USER --admin_password=$WORDPRESS_PASSWORD --admin_email=$WORDPRESS_EMAIL'

docker-compose exec wpcli_1 sh -c "INSTALL_WP_COMMAND"