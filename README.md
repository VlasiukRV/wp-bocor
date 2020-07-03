# SPG Wordpress Theme

Contents:

- [Requirements](#requirements)
- [Configuration](#configuration)
- [Installation](#installation)
- [Usage](#usage)

## Requirements

Make sure you have the latest versions of **Docker** and **Docker Compose** installed on your machine.

Clone this repository or copy the files from this repository into a new folder.

When using Linux make sure to [add your user to the `docker` group](https://docs.docker.com/install/linux/linux-postinstall/#manage-docker-as-a-non-root-user).

## Configuration

Copy and rename `.env-sample` into `.env`. Edit file to change the:
 - Site title
 - WordPress user name (default value `admin`)
 - WordPress user password (default value `admin`) 
 - WordPress user email (default value `foo@bar.com`)
 
 - default IP address
 - MySQL root password 
 - WordPress database name.

## Installation

Open a terminal and `cd` to the folder in which `docker-compose.yml` is saved and run:

```
docker-compose up
```

This creates two new folders next to your `docker-compose.yml` file.

* `wp-data` – used to store and restore database dumps
* `wp-app` – the location of your WordPress application

Docker built and run the following containers:

- [WordPress and CLI](https://hub.docker.com/_/wordpress/)    
- [MySQL](https://hub.docker.com/_/mysql/)

You should be able to access the WordPress installation with the configured IP in the browser address. By default it is [http://127.0.0.1:8000](http://127.0.0.1:8000).

For convenience you may add a new entry into your hosts file.

## Usage

### Starting containers

You can start the containers with the `up` command in daemon mode (by adding `-d` as an argument) or by using the `start` command:

```
docker-compose start
```

### Stopping containers

```
docker-compose stop
```

### Removing containers

To stop and remove all the containers use the`down` command:

```
docker-compose down
```

Use `-v` if you need to remove the database volume which is used to persist the database:

```
docker-compose down -v
```

### Creating database dumps

on linux:

```
./export.sh
```
on windows:

```
winpty sh export.sh
```

### WP CLI

The docker compose configuration also provides a service for using the [WordPress CLI](https://developer.wordpress.org/cli/commands/).

Sample command to install WordPress:

```
docker-compose run --rm wpcli core install --url=http://localhost --title=test --admin_user=admin --admin_email=test@example.com
```

Or to list installed plugins:

```
docker-compose run --rm wpcli plugin list
```

For an easier usage you may consider adding an alias for the CLI:

```
alias wp="docker-compose run --rm wpcli"
```

This way you can use the CLI command above as follows:

```
wp plugin list
```

### phpMyAdmin

You can also visit `http://127.0.0.1:8080` to access phpMyAdmin after starting the containers.

The default username is `root`, and the password is the same as supplied in the `.env` file.

### Deploy WordPress Theme into container

```
npm run build
``` 