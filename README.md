# Pangea task

# Requirements

```sh
    "php": "^7.3|^8.0",
    "mysql": "^7",
```

# Installation
```sh
   Clone the repo
   https://github.com/taghwo/pangea-task
```

```sh
    Install composer dependencies by run command below
    Composer Install
```

```sh
    create a .env file on the root of the project, Copy and paste content of .env.example into .env file
```

```sh
    add correct database credentials to .env file, like below
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=laravel
    DB_USERNAME=root
    DB_PASSWORD=
```

```sh
Run migrations
php artisan migrate
```

# Usage
```sh
    To start the app run
    php artisan server
    this will start the server on port 127.0.0.1:8000
```

## App work flow
```sh
    > Create a topic : Payload returns a unique identifier (UUID)
    > Use UUID to subscribe to a topic
    > Use UUID to publish to a topic
    > On publishing to a topic, all subscribers of that topic will get notified via their webhook URL
```

# Payload samples
```sh
CreatE Topic
Endpoint : /api/v1/topic
HTTP Verb: `POST`
{
	"title":"Go duck duck"
}
```

```sh
Subsribe to topic
Endpoint : /api/v1/subscribe/{uuid}
HTTP Verb: `POST`
{
	"url":"https://b40bdfbbb509.ngrok.io"
}
```

```sh
Publish to topic
Endpoint : /api/v1/publish/{uuid}
HTTP Verb: `POST`
{
    "name": "Taghwo",
    "age": "29"
}
```

## NOTE
```sh
For every webhook URL fired, a log is saved to database for ease of audit.
Log contains: url, data, log('if error occured,it is stored here'), attempt('Number of attempts)
```

## Test
```sh
All test cases can be found in tests/feature directory.
Migrations should be run before executing test suite
To execute all test suites run
php artisan test
```