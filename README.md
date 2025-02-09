# About this

This project originated from [Beer and Code](https://github.com/beerandcodeteam/olw-2) as part of the Laravel Método Malt training in the Multitenancy module. I have added new features in addition to the core functionalities.

## Installing the Project

The project uses Docker containers through the *Laravel Sail* package to simplify the development environment setup. Therefore, you must have Docker and Docker Compose installed on your machine.

You are free to run the project in a local environment, but this guide will not cover that scenario.

Links for Docker installation and configuration:

- [Windows](https://docs.docker.com/docker-for-windows/install/)
- [Linux (Debian-based)](https://docs.docker.com/engine/install/ubuntu/)

### Steps to Run the Project Locally:

- Clone the project to your local machine.
- Create a `.env` file. We recommend using `.env-example` as a reference.
- Add or modify the keys according to your needs.
- Navigate to the project folder via the console (Terminal/PowerShell/CMD).
- Run the following command:

```shell
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php82-composer:latest \
    composer install --ignore-platform-reqs
```

- Once the process is complete, run the command `./sail up -d`.

The first command installs the packages via Composer, as specified in the `composer.json` file. Once the installation is finished, the *vendor* folder becomes available in the project. The next command starts the containers based on the service descriptions in the `docker-compose.yml` file.

By default, no configuration changes are required in the project's `.env` file. If you need to adjust default settings (such as port bindings or database credentials), simply edit the `.env` file.

# Working with Containers

Since the project runs on Docker containers, your local machine does not need any of the required dependencies. Therefore, commands like `php artisan`, `composer`, or `npm` will not work locally. To execute commands inside one of the project's containers, such as `php artisan route:list`, you need to use Docker. For example:

```bash
docker-compose exec \ # Execute a command inside an existing container
    -u sail \ # Specifies the user to be used inside the container
    projeto_laravel.test \ # Specifies which container will receive the command
    php artisan route:list # The command to be executed
```

Executing commands this way can be cumbersome and error-prone. To streamline this process, *Laravel Sail* provides a script called `sail`, located in *vendor/bin/*. This script allows commands to be executed using aliases, making the development workflow more intuitive and less complex. Using `sail`, the same `php artisan route:list` command would be:

```bash
./vendor/bin/sail artisan route:list

# or

./vendor/bin/sail art route:list
```

### Available Commands

To view all available commands for the sail script, run `./vendor/bin/sail -h` to get a complete list of options with descriptions.

# Next Steps

Migrations allow you to version your database tables. To structure your database:

- Run `./vendor/bin/sail art migrate` to create the necessary tables in your database.
- Run `./vendor/bin/sail art db:seed` to populate your database with sample data.

Certificate [Laravel Project Series - Multi Tenancy com Laravel.pdf](https://github.com/user-attachments/files/18725837/Laravel.Project.Series.-.Multi.Tenancy.com.Laravel.pdf)

