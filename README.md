# Project Locker API

Pangea Task API

To build the app and run with docker compose

```sh
    docker-compose up --build -d
```

To view the list of container services that are running, use this docker-compose command

```sh
    docker-compose ps
```

To bash into the php container,

```sh
    docker-compose exec php bash
```

To bash into the mysql db container,

```sh
    docker-compose exec db bash
```

To stop docker container
```sh
    docker-compose stop
```

To open the app endpoint, point to
```sh
    http://0.0.0.0:80/
```

To log a container, run `docker ps` to list all containers and their ID.
Pick a container ID and run
```sh
    docker logs <container-id>
```

# creating topic payload
```sh
{
	"title":"Go duck duck"
}
```
# Published data
```sh
{
    "name": "Taghwo",
    "age": "29"
}
```

# Subsriber request payload
```sh
{
	"url":"https://b40bdfbbb509.ngrok.io"
}
```



