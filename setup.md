# Voting System

## Setting the project for the first time

### Important

To begin make sure you have [php](https:/www.php.net) not lower than the one specified in [composer.json](composer.json) file. Also you will need to have [composer](https:/www.composer.com) installed in your system.

### Setting up

Copy the env file and set up your desired settings, this include database credentials and database name which are mandatory in most cases.

```bash
cp .env.example .env
```

Then you will need to install dependencies, by running:

```bash
composer update
```

Generate the key that will be used for most of your servers operations:

```bash
php artisan key:generate
```

Run migrations to create the database tables.

```bash
php artisan migrate
```

**NB:** Some terminals will ask if the database should be created if the database as named in the [.env](.env) file is not present, in that case, you don't need to bother creating one in your DBMS software, SQL shell or [phpmyadmin](localhost). Otherwise you will need to create the database manually.

Next, run the server and ensure that there is no errors from the previous command:

```bash
php artisan serve
```

This will create a server that will be running in port [8000](http://127.0.0.1:8000) by default, if there is no other service using that port.

To change the port, you have to specify which port to be used, simply run:

```bash
php artisan serve --port=8090 # to run the server in port 8090. Adjust as per you need
```

## Running the project

Run the project by running:

```bash
php artisan serve
```

Or you can specify the port to run the server on by running:

```bash
php artisan serve --port=PORT_NUMBER # eg 3000
```
