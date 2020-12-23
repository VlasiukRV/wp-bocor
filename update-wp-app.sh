sh build-wp-theme.sh
rm -R wp-app/wp-content/themes/wp-tsb
rsync -r --progress assets/theme wp-app/wp-content/themes/wp-tsb