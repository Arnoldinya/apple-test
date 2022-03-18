# Apple-test Apple-test Development Environment

Docker
------
Make sure that docker and docker-compose are installed on your machine  

Read more about docker: https://docs.docker.com/v17.09/  
Read more about docker-compose: https://docs.docker.com/compose/

### Preparatory work
```sh
cp docker/..env.sample .env
```
Modify .env file if necessary.

### Docker Container

```sh
$ docker-compose -f docker/docker-compose.yml up
```
or
```sh
$ docker-compose -f docker/docker-compose.yml --build
```
optional -d to switch to daemon mode  

### Migrations

**For database**
```sh
$ docker exec -ti <container_name>  sh -c "php yii migrate"
```

```sh
$ docker exec -ti <container_name>  sh -c "php yii user/create 'admin' 'admin'"
```
with params:
1 - login
2 - password

If user already exists, user will be updated 